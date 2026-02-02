<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    // Indica qué modelo genera este factory
    protected $model = Review::class;

    // Define los datos por defecto para crear reseñas de prueba
    public function definition(): array
    {
        return [
            'nombre'      => $this->faker->name(),         
            'title'       => $this->faker->sentence(3),     
            'descripcion' => $this->faker->paragraph(),    
            'rating'      => $this->faker->numberBetween(3, 5), 
            'is_public'   => true,                         
        ];
    }
}
