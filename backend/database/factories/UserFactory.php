<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Factory para generar usuarios de prueba.
 *
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    // Password compartida para que no se regenere (y no sea lento) en cada usuario
    protected static ?string $password;

    /**
     * Datos por defecto del usuario.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'              => fake()->name(),
            'email'             => fake()->unique()->safeEmail(),
            'email_verified_at' => now(), // Usuario verificado por defecto
            'password'          => static::$password ??= Hash::make('password'), // Hash una sola vez
            'remember_token'    => Str::random(10),
        ];
    }

    // Estado alternativo: usuario sin email verificado
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
