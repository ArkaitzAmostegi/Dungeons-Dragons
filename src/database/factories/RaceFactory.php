<?php

namespace Database\Factories;

use App\Models\Race;
use Illuminate\Database\Eloquent\Factories\Factory;

class RaceFactory extends Factory
{
    protected $model = Race::class;

    public function definition(): array
    {
        $races = [
            'Human','Elf','Dwarf','Halfling','Dragonborn','Tiefling','Gnome','Half-Orc','Half-Elf'
        ];

        $bonusPresets = [
            'Human'      => ['any' => 1],
            'Elf'        => ['dex' => 2],
            'Dwarf'      => ['con' => 2],
            'Halfling'   => ['dex' => 2],
            'Dragonborn' => ['str' => 2, 'cha' => 1],
            'Tiefling'   => ['cha' => 2, 'int' => 1],
            'Gnome'      => ['int' => 2],
            'Half-Orc'   => ['str' => 2, 'con' => 1],
            'Half-Elf'   => ['cha' => 2, 'any' => 1],
        ];

        $name = $this->faker->unique()->randomElement($races);

        return [
            'name'        => $name,
            'description' => $this->faker->sentence(12),
            'bonuses'     => $bonusPresets[$name] ?? null, // si tu columna es JSON
        ];
    }
}
