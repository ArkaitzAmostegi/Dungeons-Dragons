<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\PersonajeController;
use Illuminate\Http\Request;

//API para el welcome, de las reviews
Route::get('/reviews', [ReviewController::class, 'index']);
//API para la web html
Route::get('/personajes', [PersonajeController::class, 'index']);

