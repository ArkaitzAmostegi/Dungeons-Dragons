<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Campañas donde participa el user (por pivot)
        $campaignIds = DB::table('campaign_user_character')
            ->where('user_id', $user->id)
            ->pluck('campaign_id')
            ->unique();

        $campaigns = Campaign::query()
            ->whereIn('id', $campaignIds)
            ->with([
                'juego',
                'memberships.user',
                'memberships.character.race',
            ])
            ->orderByDesc('created_at')
            ->get();
            

        return view('partidas.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('partidas.create');
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
     * Show the form for editing the specified resource.
     */
    public function edit(Campaign $campaign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Campaign $campaign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campaign $campaign)
    {
        //
    }
}
