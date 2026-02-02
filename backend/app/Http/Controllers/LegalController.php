<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LegalController extends Controller
{
    // Vistas legales
    public function politicaPrivacidad()
    {
        return view('legal.politicaPrivacidad');
    }

    public function terminosUso()
    {
        return view('legal.terminosUso');
    }

    public function contacto()
    {
        return view('legal.contacto');
    }

    public function accesibilidad()
    {
        return view('legal.accesibilidad');
    }

    // Procesa el formulario de contacto y envía el email
    public function enviarContacto(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mensaje' => 'required|string',
        ]);

        Mail::raw(
            "Nombre: {$validated['nombre']}\nEmail: {$validated['email']}\nMensaje:\n{$validated['mensaje']}",
            function ($message) use ($validated) {
                $message->to(['ikdgg@plaiaundi.net', 'ikdge@plaiaundi.net'])
                    ->subject('Nuevo mensaje de contacto')
                    ->from('ikdgg@plaiaundi.net', 'D&D')
                    ->replyTo($validated['email'], $validated['nombre']);
            }
        );

        return redirect()->back()->with('success', 'Tu mensaje ha sido enviado correctamente.');
    }
}
``
