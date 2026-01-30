<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LegalController extends Controller
{
    /**
     * Mostrar la página de Política de Privacidad.
     */
    public function politicaPrivacidad()
    {
        return view('legal.politicaPrivacidad');
    }

    /**
     * Mostrar la página de Términos de Uso.
     */
    public function terminosUso()
    {
        return view('legal.terminosUso');
    }

    /**
     * Mostrar la página de Contacto.
     */
    public function contacto()
    {
        return view('legal.contacto');
    }

    public function accesibilidad()
    {
        return view('legal.accesibilidad');
    }
    /**
     * Procesar el envío del formulario de Contacto.
     */

    public function enviarContacto(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mensaje' => 'required|string',
        ]);

        // Enviar correo a los destinatarios reales
        Mail::raw(
            "Nombre: {$validated['nombre']}\nEmail: {$validated['email']}\nMensaje:\n{$validated['mensaje']}",
            function ($message) use ($validated) {
                $message->to(['ikdgg@plaiaundi.net', 'ikdge@plaiaundi.net'])
                    ->subject('Nuevo mensaje de contacto')
                    ->from('ikdgg@plaiaundi.net', 'D&D')      // remitente válido
                    ->replyTo($validated['email'], $validated['nombre']); // responder al usuario
            }
        );

        return redirect()->back()->with('success', 'Tu mensaje ha sido enviado correctamente.');
    }
}
