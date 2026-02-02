<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // Middlewares que puedes aplicar a rutas específicas
    protected $routeMiddleware = [
        'admin' => \App\Http\Middleware\AdminMiddleware::class, // tu middleware
    ];
}
