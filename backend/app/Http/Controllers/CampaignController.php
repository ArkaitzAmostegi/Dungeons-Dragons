<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Juego;
use App\Models\Character;

class CampaignController extends Controller
{
    public function index(Request $request)
{
    $user = $request->user();

    // Campañas donde participa el usuario
    $campaignIds = DB::table('campaign_user_character')
        ->where('user_id', $user->id)
        ->pluck('campaign_id')
        ->unique();

    $campaigns = Campaign::query()
        ->whereIn('id', $campaignIds)
        ->where('status', '!=', 'finished')
        ->with([
            'juego',
            'memberships.user',
            'memberships.character.race',
        ])
        ->orderByDesc('created_at')
        ->get();

    // Preparar agrupación por usuario y tooltips
    $campaigns->each(function($campaign) {
        $campaign->byUser = $campaign->memberships->groupBy('user_id');

        $campaign->byUser->each(function($members) {
            $members->each(function($membership) {
                $c = $membership->character;
                if ($c) {
                    $membership->tooltip = trim(
                        $c->name
                        . ($c->race?->name ? " | Raza: {$c->race->name}" : "")
                        . " | Nivel: {$c->level}"
                        . ($c->class ? " | Clase: {$c->class}" : "")
                        . ($c->description ? " — {$c->description}" : "")
                    );
                } else {
                    $membership->tooltip = "Personaje no disponible";
                }
            });
        });
    });

    return view('partidas.index', compact('campaigns'));
}


    // Autorización mínima (solo si el usuario participa)
    private function userIsInCampaign(int $userId, Campaign $campaign): bool
    {
        return $campaign->memberships()->where('user_id', $userId)->exists();
    }

    // método finalizar() que cambia status y redirige a historial
    public function finalizar(Request $request, Campaign $campaign)
    {
        if (!$this->userIsInCampaign($request->user()->id, $campaign)) {
            abort(403);
        }

        $campaign->update(['status' => 'finished']);

        return redirect()->route('partidas.show')
            ->with('success', 'Partida marcada como finalizada');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $characters = \App\Models\Character::with('race')->get();
        $byClass = $characters->groupBy(fn($c) => $c->class ?? 'Sin Clase');

        return view('partidas.create', compact('byClass'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1️⃣ Validar campos
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'juego_id' => 'required|integer|exists:juegos,id',
            'personajes' => 'nullable|string',
        ]);

        // 2️⃣ Comprobar que haya al menos un personaje
        if (empty($data['personajes'])) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['personajes' => 'Debes seleccionar al menos un personaje.']);
        }

        $campaign = new Campaign();
        $campaign->title = $data['nombre'];
        $campaign->description = $data['descripcion'] ?? '';
        $campaign->juego_id = $data['juego_id']; // guardar el modo en juego_id
        $campaign->save();

        $userId = $request->user()->id;

        // 3️⃣ Vincular personajes con user_id
        $ids = explode(',', $data['personajes']);
        $syncData = [];
        foreach ($ids as $id) {
            $syncData[$id] = ['user_id' => $userId];
        }
        $campaign->characters()->sync($syncData);

        // 4️⃣ Asociar usuario a la campaña
        $campaign->users()->syncWithoutDetaching([$userId]);

        // 5️⃣ Redirigir con éxito
        return redirect()->route('partidas.index')
            ->with('success', 'Partida creada correctamente');
    }


    /**
     * Display the specified resource.
     */
    public function show(Campaign $campaign)
    {
        //
    }
    /**
     * Mostrar todas las campañas terminadas (historial)
     */
    public function historial(Request $request)
{
    $user = $request->user();

    // Obtener IDs de campañas donde participa el usuario
    $campaignIds = DB::table('campaign_user_character')
        ->where('user_id', $user->id)
        ->pluck('campaign_id')
        ->unique();

    // Obtener campañas finalizadas con relaciones necesarias
    $finishedCampaigns = Campaign::whereIn('id', $campaignIds)
        ->where('status', 'finished')
        ->with([
            'juego',
            'memberships.user',
        ])
        ->orderByDesc('created_at')
        ->get()
        ->map(function($c) {
            // Preparar nombres de participantes
            $c->participantsNames = $c->memberships->pluck('user.name')->implode(', ');

            // Nombre del juego o N/A si no existe
            $c->juegoNombre = $c->juego->nombre ?? 'N/A';

            // Fecha formateada
            $c->createdAt = $c->created_at->format('d/m/Y');

            return $c;
        });

    // Retornar la vista con los datos ya procesados
    return view('partidas.show', compact('finishedCampaigns'));
}

    /**
     * Devuelve una vista con el formulario
     */
    public function edit(Request $request, Campaign $campaign)
    {
        if (!$this->userIsInCampaign($request->user()->id, $campaign)) {
            abort(403);
        }

        $campaign->load('juego');
        $juegos = Juego::orderBy('nombre')->get();

        return view('partidas.edit', compact('campaign', 'juegos'));
    }


    /**
     * Actualiza título/descripcion/juego (ajusta nombres de campos al form)
     */
    public function update(Request $request, Campaign $campaign)
    {
        if (!$this->userIsInCampaign($request->user()->id, $campaign)) {
            abort(403);
        }

        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'juego_id' => 'required|integer|exists:juegos,id',
        ]);

        $campaign->update([
            'title' => $data['nombre'],
            'description' => $data['descripcion'] ?? '',
            'juego_id' => $data['juego_id'],
        ]);

        return redirect()->route('partidas.index')->with('success', 'Partida actualizada');
    }

    public function destroy(Request $request, Campaign $campaign)
    {
        if (!$this->userIsInCampaign($request->user()->id, $campaign)) {
            abort(403);
        }

        $campaign->memberships()->delete(); // borra campaign_user_character
        $campaign->delete();

        return redirect()->route('partidas.index')->with('success', 'Partida eliminada');
    }
}
