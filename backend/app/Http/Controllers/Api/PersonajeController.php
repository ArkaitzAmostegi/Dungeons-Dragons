<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Character;

class PersonajeController extends Controller
{
    public function index()
    {
        return Character::query()
            ->with('race:id,name')
            ->select('id','name','level','race_id')
            ->orderBy('name')
            ->get();
    }
}
