<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ReviewController;

Route::get('/reviews', [ReviewController::class, 'index']);
