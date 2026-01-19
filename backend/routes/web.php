<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\BestiarioController;

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




require __DIR__ . '/auth.php';
