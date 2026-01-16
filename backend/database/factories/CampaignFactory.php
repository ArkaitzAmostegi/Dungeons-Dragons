<?php

namespace Database\Factories;

use App\Models\Campaign;
use Illuminate\Database\Eloquent\Factories\Factory;

class CampaignFactory extends Factory
{
    protected $model = Campaign::class;

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
            'title'       => $this->faker->randomElement($titles) . ' #' . $this->faker->unique()->numberBetween(1, 99),
            'description' => $this->faker->paragraph(),
            'status'      => $this->faker->randomElement(['active', 'finished']),
        ];
    }
}
