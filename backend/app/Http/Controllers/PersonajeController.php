<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Character;
use Illuminate\Http\Request;

class PersonajeController extends Controller
{
    // Lista personajes y permite filtrar por nombre con ?q=
    public function index(Request $request)
    {
        $q = $request->query('q'); // Texto de búsqueda (query string)

        return Character::query()
            ->when($q, fn($qry) => $qry->where('name', 'like', "%{$q}%")) // Aplica filtro si hay q
            ->latest() // Ordena por created_at desc
            ->get();   // Devuelve JSON con los resultados
    }
}
