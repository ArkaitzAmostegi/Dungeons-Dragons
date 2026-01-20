<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        return Review::query()
            ->where('is_public', true)
            ->latest()
            ->take(6)
            ->get();
    }
}
