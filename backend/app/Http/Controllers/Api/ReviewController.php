<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

/**
 * Controlador API para obtener reseñas (reviews).
 * (Endpoint típico: GET /api/reviews)
 */
class ReviewController extends Controller
{
    /**
     * Devuelve una lista de reseñas públicas (máximo 6) en formato JSON.
     *
     * - Filtra solo las reseñas marcadas como públicas (is_public = true)
     * - Ordena por la fecha más reciente (latest() = ORDER BY created_at DESC por defecto)
     * - Limita el resultado a 6 registros
     * - Maneja errores de base de datos devolviendo 500
     */
    public function index(): JsonResponse
    {
        try {
            $reviews = Review::query()           // Inicia una query Eloquent sobre el modelo Review
                ->where('is_public', true)       
                ->latest()                       
                ->take(6)                       
                ->get();                         

            return response()->json($reviews, 200); 

        } catch (QueryException $e) {             // Captura errores relacionados con consultas SQL/DB
            return response()->json([
                'message' => 'Error al obtener las reseñas'
            ], 500);                              // Respuesta de error 500 Internal Server Error
        }
    }
}
