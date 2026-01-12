<?php

namespace Database\Factories;

use App\Models\Character;
use App\Models\Race;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CharacterFactory extends Factory
{
    protected $model = Character::class;

    public function definition(): array
    {
        $classes = [
            'Barbarian','Bard','Cleric','Druid','Fighter','Monk',
            'Paladin','Ranger','Rogue','Sorcerer','Warlock','Wizard'
        ];

        $names = [
            'Aelar','Borin','Kael','Lira','Thrain','Seraphine','Mira','Dorian',
            'Nyx','Ragnar','Eldrin','Frey','Zara','Cassian','Orin'
        ];

        return [
            'user_id'     => User::factory(),
            'race_id'     => Race::factory(),
            'name'        => $this->faker->randomElement($names) . ' ' . $this->faker->unique()->randomNumber(3),
            'level'       => $this->faker->numberBetween(1, 12),
            'class'       => $this->faker->randomElement($classes),
            'description' => $this->faker->optional()->sentence(16),
        ];
    }
}
