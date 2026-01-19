<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BestiarioController extends Controller
{
    public function index()
    {
        // Llamada a la API de ejemplo: Acid Arrow
        $response = Http::get('https://www.dnd5eapi.co/api/2014/spells/acid-arrow/');
        
        if ($response->successful()) {
            $spell = $response->json(); // obtiene los datos en array
        } else {
            $spell = null;
        }

        return view('bestiario.index', compact('spell'));
    }
}
