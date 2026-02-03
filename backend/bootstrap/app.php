<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Configura y crea la instancia principal de la aplicación Laravel
return Application::configure(basePath: dirname(__DIR__))
    // Define qué archivos de rutas se cargan (web, api, consola) y el endpoint de health-check
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'premium' => \App\Http\Middleware\PremiumMiddleware::class,
        ]);
    })
    // Punto para configurar el manejo de excepciones (reporting/rendering) si se necesita
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    // Crea la aplicación
    ->create();
