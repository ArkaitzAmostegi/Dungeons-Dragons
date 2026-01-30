<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class ReviewController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $reviews = Review::query()
                ->where('is_public', true)
                ->latest()
                ->take(6)
                ->get();

            return response()->json($reviews, 200);

        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Error al obtener las reseñas'
            ], 500);
        }
    }
}
