<?php

namespace Database\Factories;

use App\Models\Campaign;
use Illuminate\Database\Eloquent\Factories\Factory;

class CampaignFactory extends Factory
{
    // Indica qué modelo genera este factory
    protected $model = Campaign::class;

    // Define los datos por defecto para crear campañas de prueba
    public function definition(): array
    {
        $titles = [
            'Curse of the Crimson Keep',
            'Shadows over Neverwinter',
            'The Lost Mines Reforged',
            'Vault of the Dragon Queen',
            'Storms of the Astral Sea',
            'The Caves of Blackfang'
        ];

        return [
            // Título aleatorio + número único para evitar duplicados
            'title'       => $this->faker->randomElement($titles) . ' #' . $this->faker->unique()->numberBetween(1, 99),
            // Descripción de ejemplo
            'description' => $this->faker->paragraph(),
            // Estado aleatorio (activa o finalizada)
            'status'      => $this->faker->randomElement(['active', 'finished']),
        ];
    }
}

