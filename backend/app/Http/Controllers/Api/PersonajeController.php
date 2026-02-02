<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Character;

/**
 * Controlador API para gestionar la obtención de personajes.
 * (Endpoint típico: GET /api/personajes)
 */
class PersonajeController extends Controller
{
    /**
     * Devuelve el listado de personajes en formato JSON.
     *
     * Incluye la relación "race" (solo id y name) para cada personaje,
     * selecciona únicamente campos necesarios del personaje y ordena por nombre.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Character::query()                 // Inicia una query Eloquent sobre el modelo Character
            ->with('race:id,name')               
            ->select('id','name','level','race_id') 
            ->orderBy('name')                    
            ->get();                            
    }
}

