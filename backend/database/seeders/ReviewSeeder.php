<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        // Reseñas manuales
        $reviews = [
            [
                'nombre' => 'Ana M.',
                'title' => '¡Genial!',
                'descripcion' => 'La aplicación hace que organizar partidas de D&D sea muy fácil y divertido. ¡Me encanta!',
                'rating' => 5,
                'is_public' => true,
            ],
            [
                'nombre' => 'Carlos R.',
                'title' => 'Muy útil',
                'descripcion' => 'Poder gestionar personajes y campañas desde un solo lugar es increíble. Muy recomendable.',
                'rating' => 4,
                'is_public' => true,
            ],
            [
                'nombre' => 'Lucía P.',
                'title' => 'Fácil de usar',
                'descripcion' => 'La interfaz es clara y sencilla. Me ahorra mucho tiempo al preparar las partidas.',
                'rating' => 5,
                'is_public' => true,
            ],
            [
                'nombre' => 'Miguel S.',
                'title' => 'Ideal para DMs',
                'descripcion' => 'Como master, puedo controlar los personajes y campañas fácilmente. ¡Perfecto!',
                'rating' => 5,
                'is_public' => true,
            ],
            [
                'nombre' => 'Sofía L.',
                'title' => 'Muy completa',
                'descripcion' => 'Tiene todas las herramientas que necesitábamos para organizar nuestras partidas online.',
                'rating' => 4,
                'is_public' => true,
            ],
            [
                'nombre' => 'David G.',
                'title' => 'Mejor que otras apps',
                'descripcion' => 'Llevo tiempo probando otras apps de D&D y esta supera a todas en simplicidad y funcionalidad.',
                'rating' => 5,
                'is_public' => true,
            ],
            [
                'nombre' => 'Marta F.',
                'title' => 'Perfecta para principiantes',
                'descripcion' => 'Mis amigos nuevos en D&D la entienden rápido y podemos jugar sin problemas.',
                'rating' => 5,
                'is_public' => true,
            ],
            [
                'nombre' => 'Javier T.',
                'title' => 'Organización impecable',
                'descripcion' => 'Mantener las campañas y los personajes ordenados nunca fue tan fácil. Me encanta la app.',
                'rating' => 4,
                'is_public' => true,
            ],
            [
                'nombre' => 'Elena V.',
                'title' => 'Muy recomendable',
                'descripcion' => 'Si eres jugador o master, esta app te hará la vida mucho más fácil. ¡5 estrellas!',
                'rating' => 5,
                'is_public' => true,
            ],
            [
                'nombre' => 'Pablo H.',
                'title' => 'Divertida y práctica',
                'descripcion' => 'Además de organizar partidas, la app tiene un diseño bonito y divertido.',
                'rating' => 4,
                'is_public' => true,
            ],
        ];

        foreach ($reviews as $review) {
            Review::create($review);
        }

        // Crear 5 reseñas adicionales con factory
        Review::factory()->count(5)->create();
    }
}
