<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;


class BestiarioController extends Controller
{

    public function index()
    {
        // Traemos solo los nombres e índices
        $response = Http::get('https://www.dnd5eapi.co/api/2014/monsters');

        $monsters = $response->successful() ? $response->json()['results'] : [];

        return view('bestiario.index', compact('monsters'));
    }

     public function show(string $monster)
    {
        // Traemos los datos completos de un monstruo
        $response = Http::get("https://www.dnd5eapi.co/api/2014/monsters/{$monster}");

        $monster = $response->successful() ? $response->json() : null;

        return view('bestiario.show', compact('monster'));
    }
}
