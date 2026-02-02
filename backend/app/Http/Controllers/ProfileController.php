```php
<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    // Muestra el formulario de edición del perfil
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(), // Usuario autenticado
        ]);
    }

    // Actualiza los datos del perfil
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated()); // Aplica solo datos validados

        if ($request->user()->isDirty('email')) {      // Si cambió el email, se desverifica
            $request->user()->email_verified_at = null;
        }

        $request->user()->save(); // Guarda cambios

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    // Elimina la cuenta del usuario
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'], // Confirma contraseña
        ]);

        $user = $request->user();

        Auth::logout();  // Cierra sesión antes de borrar
        $user->delete(); // Borra usuario

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

