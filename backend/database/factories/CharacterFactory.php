```php
<?php

namespace Database\Factories;

use App\Models\Character;
use App\Models\Race;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CharacterFactory extends Factory
{
    // Indica qué modelo genera este factory
    protected $model = Character::class;

    // Define los datos por defecto para crear personajes de prueba
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
            // Crea una raza asociada automáticamente (factory anidado)
            'race_id'     => Race::factory(),
            // Nombre aleatorio + número único para evitar duplicados
            'name'        => $this->faker->randomElement($names) . ' ' . $this->faker->unique()->randomNumber(3),
            // Nivel entre 1 y 12
            'level'       => $this->faker->numberBetween(1, 12),
            // Clase aleatoria
            'class'       => $this->faker->randomElement($classes),
            // Descripción opcional (a veces null)
            'description' => $this->faker->optional()->sentence(16),
        ];
    }
}
