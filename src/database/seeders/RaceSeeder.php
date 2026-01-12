<?php

namespace Database\Seeders;

use App\Models\Race;
use Illuminate\Database\Seeder;

class RaceSeeder extends Seeder
{
    public function run(): void
    {
        $races = [
            ['name' => 'Human',      'description' => 'Versatile and ambitious.',      'bonuses' => ['any' => 1]],
            ['name' => 'Elf',        'description' => 'Graceful and magical.',          'bonuses' => ['dex' => 2]],
            ['name' => 'Dwarf',      'description' => 'Tough and resilient.',           'bonuses' => ['con' => 2]],
            ['name' => 'Halfling',   'description' => 'Small, lucky, and nimble.',      'bonuses' => ['dex' => 2]],
            ['name' => 'Dragonborn', 'description' => 'Draconic heritage and pride.',   'bonuses' => ['str' => 2, 'cha' => 1]],
            ['name' => 'Tiefling',   'description' => 'Infernal bloodline.',            'bonuses' => ['cha' => 2, 'int' => 1]],
            ['name' => 'Gnome',      'description' => 'Clever and curious.',            'bonuses' => ['int' => 2]],
            ['name' => 'Half-Orc',   'description' => 'Strong and relentless.',         'bonuses' => ['str' => 2, 'con' => 1]],
            ['name' => 'Half-Elf',   'description' => 'Charm and adaptability.',        'bonuses' => ['cha' => 2, 'any' => 1]],
        ];

        foreach ($races as $race) {
            Race::updateOrCreate(
                ['name' => $race['name']],
                ['description' => $race['description'], 'bonuses' => $race['bonuses']]
            );
        }
    }
}
