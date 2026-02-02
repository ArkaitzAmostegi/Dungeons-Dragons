<?php

namespace Database\Factories;

use App\Models\Race;
use Illuminate\Database\Eloquent\Factories\Factory;

class RaceFactory extends Factory
{
    // Indica qué modelo genera este factory
    protected $model = Race::class;

    // Define los datos por defecto para crear razas de prueba
    public function definition(): array
    {
        $races = [
            'Human','Elf','Dwarf','Halfling','Dragonborn','Tiefling','Gnome','Half-Orc','Half-Elf'
        ];

        // Presets de bonificaciones por raza (se guardan en JSON/array)
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

        $name = $this->faker->unique()->randomElement($races); // Evita repetir nombres de raza

        return [
            'name'        => $name,
            'description' => $this->faker->sentence(12),
            'bonuses'     => $bonusPresets[$name] ?? null, // Bonos según la raza (si la columna es JSON)
        ];
    }
}
`
