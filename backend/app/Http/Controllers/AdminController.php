<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Campaign;
use App\Models\Character;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Muestra el dashboard de administración
    public function index()
{
    return view('admin.dashboard', [
        'usersCount' => User::count(),
        'campaignsCount' => Campaign::count(),
        'charactersCount' => Character::count(),
    ]);
}


    // LISTADO DE CAMPAÑAS
    public function campaigns()
    {
        $campaigns = \App\Models\Campaign::all(); // Obtiene todas las campañas de la base de datos
        return view('admin.campaigns.index', compact('campaigns'));
    }

    // FORMULARIO PARA CREAR CAMPAÑA
    public function createCampaign()
    {
        return view('admin.campaigns.create');
    }

    // ELIMINAR CAMPAÑA
    public function destroyCampaign(\App\Models\Campaign $campaign)
    {
        $campaign->delete(); // Borra la campaña de la base de datos
        return redirect()->route('admin.campaigns')->with('success', 'Campaña eliminada.'); // Redirige con mensaje de éxito
    }

    // LISTADO DE PERSONAJES
    public function characters()
    {
        $characters = \App\Models\Character::all(); // Obtiene todos los personajes
        return view('admin.characters.index', compact('characters')); // Pasa los personajes a la vista
    }

    // FORMULARIO PARA CREAR PERSONAJE
    public function createCharacter()
    {
        return view('admin.characters.create');
    }

    // GUARDAR PERSONAJE NUEVO
    public function storeCharacter(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        \App\Models\Character::create($request->all()); // Crea un nuevo personaje con todos los datos del formulario

        // Redirige a la lista de personajes con mensaje de éxito
        return redirect()->route('admin.characters')->with('success', 'Personaje creado correctamente.');
    }

    // FORMULARIO PARA EDITAR PERSONAJE
    public function editCharacter(\App\Models\Character $character)
    {
        return view('admin.characters.edit', compact('character')); // Pasa el personaje a la vista de edición
    }

    // ELIMINAR PERSONAJE
    public function destroyCharacter(\App\Models\Character $character)
    {
        $character->delete(); // Borra el personaje de la base de datos
        return redirect()->route('admin.characters')->with('success', 'Personaje eliminado correctamente.');
    }

    // LISTADO DE USUARIOS
    public function users()
    {
        $users = User::all(); // Obtiene todos los usuarios
        return view('admin.users.index', compact('users')); // Pasa los usuarios a la vista
    }

    // FORMULARIO PARA CREAR USUARIO
    public function createUser()
    {
        return view('admin.users.create');
    }

    // GUARDAR NUEVO USUARIO
    public function storeUser(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255', // Nombre obligatorio
            'email' => 'required|email|unique:users', // Email obligatorio, válido y único
            'password' => 'required|string|min:6', // Contraseña obligatoria con mínimo 6 caracteres
            'role' => 'required|in:user,admin', // Rol obligatorio, solo puede ser 'user' o 'admin'
        ]);

        // Crear el usuario en la base de datos
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encripta la contraseña
            'role' => $request->role,
        ]);

        // Redirige a la lista de usuarios con mensaje de éxito
        return redirect()->route('admin.users')->with('success', 'Usuario creado correctamente.');
    }

    // ELIMINAR USUARIO
    public function destroyUser(User $user)
    {
        $user->delete(); // Borra el usuario de la base de datos
        return redirect()->route('admin.users')->with('success', 'Usuario eliminado correctamente');
    }
}
