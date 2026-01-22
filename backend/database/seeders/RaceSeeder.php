<?php

namespace Database\Seeders;

use App\Models\Race;
use Illuminate\Database\Seeder;

class RaceSeeder extends Seeder
{
    public function run(): void
    {
       $races = [
    ['name' => 'Humano',     'description' => 'Versátil y ambicioso.',         'bonuses' => ['any' => 1]],
    ['name' => 'Elfo',       'description' => 'Elegante y mágico.',           'bonuses' => ['dex' => 2]],
    ['name' => 'Enano',      'description' => 'Fuerte y resistente.',         'bonuses' => ['con' => 2]],
    ['name' => 'Mediano',    'description' => 'Pequeño, afortunado y ágil.', 'bonuses' => ['dex' => 2]],
    ['name' => 'Orco',       'description' => 'Feroz y fuerte, guerrero nato.', 'bonuses' => ['str' => 2, 'con' => 1]],
    ['name' => 'Dragonborn', 'description' => 'Herencia dracónica y orgulloso.', 'bonuses' => ['str' => 2, 'cha' => 1]],
    ['name' => 'Tiefling',   'description' => 'Sangre infernal.',             'bonuses' => ['cha' => 2, 'int' => 1]],
    ['name' => 'Gnomo',      'description' => 'Ingenioso y curioso.',         'bonuses' => ['int' => 2]],
    ['name' => 'Semi-Orco',  'description' => 'Fuerte e implacable.',        'bonuses' => ['str' => 2, 'con' => 1]],
    ['name' => 'Semi-Elfo',  'description' => 'Encantador y adaptable.',      'bonuses' => ['cha' => 2, 'any' => 1]],
];


        foreach ($races as $race) {
            Race::updateOrCreate(
                ['name' => $race['name']],
                ['description' => $race['description'], 'bonuses' => $race['bonuses']]
            );
        }
    }
}
