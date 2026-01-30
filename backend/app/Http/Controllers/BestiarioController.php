<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class BestiarioController extends Controller
{
    public function index()
{
    try {
        $response = Http::timeout(5)
            ->get('https://www.dnd5eapi.co/api/2014/monsters');

        if ($response->failed()) {
            return view('bestiario.index', [
                'monsters' => [],
                'error' => 'No se pudo cargar el listado de monstruos.'
            ]);
        }

        return view('bestiario.index', [
            'monsters' => $response->json()['results'],
            'error' => null
        ]);

    } catch (\Exception $e) {
        return view('bestiario.index', [
            'monsters' => [],
            'error' => 'No se pudo cargar el listado de monstruos.'
        ]);
    }
}


    public function show(string $monster)
    {
        try {
            $response = Http::timeout(5)
                ->get("https://www.dnd5eapi.co/api/2014/monsters/{$monster}");

            if ($response->status() === 404) {
                abort(404);
            }

            if ($response->failed()) {
                return view('bestiario.show', [
                    'monster' => null,
                    'error' => 'No se pudo cargar el monstruo.'
                ]);
            }

            return view('bestiario.show', [
                'monster' => $response->json(),
                'error' => null
            ]);

        } catch (\Exception $e) {
            return view('bestiario.show', [
                'monster' => null,
                'error' => 'Error de conexión con la API.'
            ]);
        }
    }
}
