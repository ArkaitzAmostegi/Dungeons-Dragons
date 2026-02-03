<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class PremiumMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Verifica si está logueado y es premium
        if (!$user || !$user->is_premium) {
            return response()->view('premium.not-premium', [], 403);
        }


        return $next($request);
    }
}
