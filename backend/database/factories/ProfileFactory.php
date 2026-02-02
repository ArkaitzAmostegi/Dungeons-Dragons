<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    // Indica qué modelo genera este factory
    protected $model = Profile::class;

    // Define los datos por defecto para crear perfiles de prueba
    public function definition(): array
    {
        return [
            // Crea un usuario asociado automáticamente (factory anidado)
            'user_id'  => User::factory(),
            // Nickname único
            'nickname' => $this->faker->unique()->userName(),
            // Bio opcional (a veces null)
            'bio'      => $this->faker->optional()->paragraph(),
            // Avatar por defecto (null si no se usa imagen)
            'avatar'   => null,
        ];
    }
}
