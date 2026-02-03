<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PremiumController extends Controller
{
    public function index()
    {
        return view('premium.index');
    }

    public function checkout(Request $request)
{
    Stripe::setApiKey(env('STRIPE_SECRET'));

    $session = Session::create([
        'payment_method_types' => ['card'],
        'mode' => 'subscription',
        'line_items' => [[
            'price' => 'price_1SwfjjQ8YzHr6X3d7RoNufW9',
            'quantity' => 1,
        ]],
        'success_url' => route('premium.success'),
        'cancel_url' => route('premium.index'),
    ]);

    return redirect($session->url);
}


    public function success()
    {
        $user = Auth::user();
        $user->is_premium = true;
        $user->save();

        return redirect()->route('premium.index')->with('success', '¡Pago completado! Ahora eres premium.');
    }
}

