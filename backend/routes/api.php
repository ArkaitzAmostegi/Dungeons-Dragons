<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\PersonajeController;

Route::get('/reviews', [ReviewController::class, 'index']);
Route::get('/personajes', [PersonajeController::class, 'index']);