<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Campañas donde participa el user (por pivot)
        $campaignIds = \DB::table('campaign_user_character')
            ->where('user_id', $user->id)
            ->pluck('campaign_id')
            ->unique();

        $campaigns = \App\Models\Campaign::query()
            ->whereIn('id', $campaignIds)
            ->with([
                'juego',
                'memberships.user',
                'memberships.character.race', // opcional si quieres mostrar raza
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
