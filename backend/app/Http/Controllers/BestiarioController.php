<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;


class BestiarioController extends Controller
{
    
    public function index()
    {
        $response = Http::get('https://www.dnd5eapi.co/api/2014/monsters');

        $monsters = $response->successful()
            ? $response->json()['results']
            : [];

        return view('bestiario.index', compact('monsters'));
    }
    public function show(string $monster)
{
    $response = Http::get("https://www.dnd5eapi.co/api/2014/monsters/{$monster}");

    $monsterData = $response->successful()
        ? $response->json()
        : null;

    return view('bestiario.show', compact('monsterData'));
}

    
}
