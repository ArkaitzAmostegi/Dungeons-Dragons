<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Character;
use Illuminate\Http\Request;

class PersonajeController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        return Character::query()
            ->when($q, fn($qry) => $qry->where('name', 'like', "%{$q}%"))
            ->latest()
            ->get();
    }
}
