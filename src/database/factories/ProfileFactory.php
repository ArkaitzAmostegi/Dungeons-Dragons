<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    public function definition(): array
    {
        return [
            'user_id'   => User::factory(),
            'nickname'  => $this->faker->unique()->userName(),
            'bio'       => $this->faker->optional()->paragraph(),
            'avatar'    => null, // o "images/avatars/..." si usas assets
        ];
    }
}
