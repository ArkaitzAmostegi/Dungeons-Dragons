<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\BestiarioController;
use App\Http\Controllers\AboutController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return redirect()->route('partidas.index');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Ruta para la página de partidas, Home
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/partidas', [CampaignController::class, 'index'])->name('partidas.index');
    Route::get('/partidas/crear', [CampaignController::class, 'create'])->name('partidas.create');
    Route::post('/partidas', [CampaignController::class, 'store'])->name('partidas.store');
    
    Route::get('/partidas/{campaign}/edit', [CampaignController::class, 'edit'])->name('partidas.edit');
    Route::put('/partidas/{campaign}', [CampaignController::class, 'update'])->name('partidas.update');
    Route::delete('/partidas/{campaign}', [CampaignController::class, 'destroy'])->name('partidas.destroy');
    Route::patch('/partidas/{campaign}/finalizar', [CampaignController::class, 'finalizar'])->name('partidas.finalizar');
});

Route::get('/bestiario', [BestiarioController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('bestiario.index');
Route::get('/bestiario/{monster}', [BestiarioController::class, 'show'])
    ->name('bestiario.show')
    ->middleware(['auth', 'verified']);


Route::get('/historial', [CampaignController::class, 'historial'])
    ->middleware(['auth', 'verified'])
    ->name('partidas.show');


Route::get('/about', [AboutController::class, 'index'])->name('about.index');

//Rutas para la API del frontend, para que el user() funcione en la API
Route::get('/me', function () {
    if (!auth()->check()) return response()->json(['authenticated' => false]);

    return response()->json([
        'authenticated' => true,
        'name' => auth()->user()->name,
        'email' => auth()->user()->email,
    ]);
});

Route::get('/me-public', function () {
    return ['authenticated' => false];
});




require __DIR__ . '/auth.php';
