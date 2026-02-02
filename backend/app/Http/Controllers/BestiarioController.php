<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http; // Permite hacer solicitudes HTTP externas

class BestiarioController extends Controller
{
    // LISTADO DE MONSTRUOS
    public function index()
    {
        try {
            // Hacemos una petición GET a la API de D&D para obtener todos los monstruos
            // con un timeout de 5 segundos
            $response = Http::timeout(5)
                ->get('https://www.dnd5eapi.co/api/2014/monsters');

            // Si la respuesta falla (error HTTP)
            if ($response->failed()) {
                return view('bestiario.index', [
                    'monsters' => [], // Lista vacía
                    'error' => 'No se pudo cargar el listado de monstruos.' // Mensaje de error
                ]);
            }

            // Si la respuesta es correcta, pasamos los resultados a la vista
            return view('bestiario.index', [
                'monsters' => $response->json()['results'], // Extraemos la lista de monstruos
                'error' => null // No hay error
            ]);

        } catch (\Exception $e) {
            // Captura cualquier excepción (como problemas de conexión)
            return view('bestiario.index', [
                'monsters' => [], // Lista vacía
                'error' => 'No se pudo cargar el listado de monstruos.' // Mensaje de error
            ]);
        }
    }

    // DETALLE DE UN MONSTRUO
    public function show(string $monster)
    {
        try {
            // Petición GET a la API para obtener los datos de un monstruo específico
            $response = Http::timeout(5)
                ->get("https://www.dnd5eapi.co/api/2014/monsters/{$monster}");

            // Si la API devuelve 404, abortamos con error 404
            if ($response->status() === 404) {
                abort(404);
            }

            // Si falla la petición HTTP por otro motivo
            if ($response->failed()) {
                return view('bestiario.show', [
                    'monster' => null, // Sin datos
                    'error' => 'No se pudo cargar el monstruo.' // Mensaje de error
                ]);
            }

            // Si todo va bien, pasamos los datos del monstruo a la vista
            return view('bestiario.show', [
                'monster' => $response->json(), // Datos del monstruo
                'error' => null // Sin error
            ]);

        } catch (\Exception $e) {
            // Captura cualquier excepción, como problemas de conexión
            return view('bestiario.show', [
                'monster' => null, // Sin datos
                'error' => 'Error de conexión con la API.' // Mensaje de error
            ]);
        }
    }
}
