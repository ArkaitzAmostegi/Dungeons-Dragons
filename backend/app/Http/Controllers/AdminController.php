<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Dashboard
    public function index()
    {
        return view('admin.dashboard');
    }
    public function campaigns()
{
    $campaigns = \App\Models\Campaign::all();
    return view('admin.campaigns.index', compact('campaigns'));
}

public function createCampaign()
{
    return view('admin.campaigns.create');
}

public function destroyCampaign(\App\Models\Campaign $campaign)
{
    $campaign->delete();
    return redirect()->route('admin.campaigns')->with('success', 'Campaña eliminada.');
}

public function characters()
{
    $characters = \App\Models\Character::all();
    return view('admin.characters.index', compact('characters'));
}

public function createCharacter()
{
    return view('admin.characters.create');
}

public function storeCharacter(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        // Añade otros campos necesarios
    ]);

    \App\Models\Character::create($request->all());

    return redirect()->route('admin.characters')->with('success', 'Personaje creado correctamente.');
}

public function editCharacter(\App\Models\Character $character)
{
    return view('admin.characters.edit', compact('character'));
}

public function destroyCharacter(\App\Models\Character $character)
{
    $character->delete();
    return redirect()->route('admin.characters')->with('success', 'Personaje eliminado correctamente.');
}


    // Lista todos los usuarios
    public function users()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Mostrar formulario crear usuario
    public function createUser()
    {
        return view('admin.users.create');
    }

    // Guardar nuevo usuario
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:user,admin',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')->with('success', 'Usuario creado correctamente.');
    }

    // Eliminar usuario
    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Usuario eliminado correctamente');
    }
}
