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

        // IDs de campañas en las que participa el usuario (tabla pivot)
        $campaignIds = DB::table('campaign_user_character')
            ->where('user_id', $user->id)
            ->pluck('campaign_id')
            ->unique();

        // Campañas activas (no finalizadas) con sus relaciones necesarias
        $campaigns = Campaign::query()
            ->whereIn('id', $campaignIds)
            ->where('status', '!=', 'finished')
            ->with(['juego', 'memberships.user', 'memberships.character.race'])
            ->orderByDesc('created_at')
            ->get();

        return view('partidas.index', compact('campaigns'));
    }

    // Comprueba que el usuario participa en la campaña
    private function userIsInCampaign(int $userId, Campaign $campaign): bool
    {
        return $campaign->memberships()->where('user_id', $userId)->exists();
    }

    // Marca la campaña como finalizada
    public function finalizar(Request $request, Campaign $campaign)
    {
        if (!$this->userIsInCampaign($request->user()->id, $campaign)) {
            abort(403);
        }

        $campaign->update(['status' => 'finished']);

        return redirect()->route('partidas.show')
            ->with('success', 'Partida marcada como finalizada');
    }

  
public function create()
{
    $characters = Character::with('race')->get();
    $byClass = $characters->groupBy(fn($c) => $c->class ?? 'Sin Clase');

    return view('partidas.create', compact('byClass'));
}


    public function store(Request $request)
    {
        // Valida datos del formulario
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'juego_id' => 'required|integer|exists:juegos,id',
            'personajes' => 'nullable|string',
        ]);

        // Exige al menos un personaje seleccionado
        if (empty($data['personajes'])) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['personajes' => 'Debes seleccionar al menos un personaje.']);
        }

        // Crea la campaña
        $campaign = new Campaign();
        $campaign->title = $data['nombre'];
        $campaign->description = $data['descripcion'] ?? '';
        $campaign->juego_id = $data['juego_id'];
        $campaign->save();

        $userId = $request->user()->id;

        // Vincula personajes a la campaña guardando también el user_id en el pivot
        $ids = explode(',', $data['personajes']);
        $syncData = [];
        foreach ($ids as $id) {
            $syncData[$id] = ['user_id' => $userId];
        }
        $campaign->characters()->sync($syncData);

        // Vincula usuario a la campaña (sin borrar otros)
        $campaign->users()->syncWithoutDetaching([$userId]);

        return redirect()->route('partidas.index')
            ->with('success', 'Partida creada correctamente');
    }

    public function show(Campaign $campaign)
    {
        //
    }

    // Historial de campañas finalizadas del usuario
    public function historial(Request $request)
    {
        $user = $request->user();

        $campaignIds = DB::table('campaign_user_character')
            ->where('user_id', $user->id)
            ->pluck('campaign_id')
            ->unique();

        $finishedCampaigns = Campaign::whereIn('id', $campaignIds)
            ->where('status', 'finished')
            ->with(['juego', 'memberships.user', 'memberships.character.race'])
            ->orderByDesc('created_at')
            ->get();

        return view('partidas.show', compact('finishedCampaigns'));
    }

    // Formulario de edición (solo si participa)
    public function edit(Request $request, Campaign $campaign)
    {
        if (!$this->userIsInCampaign($request->user()->id, $campaign)) {
            abort(403);
        }

        $campaign->load('juego');
        $juegos = Juego::orderBy('nombre')->get();

        return view('partidas.edit', compact('campaign', 'juegos'));
    }

    // Actualiza los campos principales de la campaña
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
