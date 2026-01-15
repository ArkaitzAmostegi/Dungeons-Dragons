<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Character;
use App\Models\Profile;
use App\Models\Race;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Juego;

class DndSeeder extends Seeder
{
    public function run(): void
    {
        // Asegura razas
        if (Race::count() === 0) {
            $this->call(RaceSeeder::class);
        }

        // 1) Crear usuarios con perfil
        $users = User::factory()
            ->count(8)
            ->create([
                'password' => Hash::make('password'),
            ])
            // Se crea el profile para cada usuario
            ->each(function (User $user) {
                Profile::factory()->create(['user_id' => $user->id]);
            });

        // 2) Crear personajes para cada usuario (2-4 por user)
        $allCharacters = collect();

        foreach ($users as $user) {
            $chars = Character::factory()
                ->count(rand(2, 4))
                ->create([
                    'user_id' => $user->id,
                    'race_id' => Race::inRandomOrder()->value('id'),
                ]);

            $allCharacters = $allCharacters->merge($chars);
        }

         // 3) Crear 3-4 campañas por usuario (cada user "tiene" campañas)
        $juegoIds = Juego::pluck('id');

        foreach ($users as $user) {
            $myChars = $allCharacters->where('user_id', $user->id)->values();

            // seguridad: si por lo que sea no tiene chars, saltamos
            if ($myChars->isEmpty()) {
                continue;
            }

            $campaigns = Campaign::factory()
                ->count(rand(3, 4)) // <-- 3 a 5 campañas por user
                ->create([
                    'juego_id' => fn () => $juegoIds->random(),
                    // si tienes status aleatorio en factory, no lo fuerces aquí
                ]);

            // 4) En cada campaña: owner (un char del user) + jugadores extra
            foreach ($campaigns as $campaign) {
                // owner (un personaje del usuario creador)
                $ownerChar = $myChars->random();

                $campaign->characters()->attach($ownerChar->id, [
                    'user_id' => $user->id,
                    'role' => 'owner', // o 'dm' si prefieres
                ]);

                // jugadores extra (evita repetir el owner)
                $extraCount = rand(2, 5);
                $extrasPool = $allCharacters
                    ->where('user_id', '!=', $user->id)   // no metas personajes del mismo user
                    ->values();

                $extras = $extrasPool->random(min($extraCount, $extrasPool->count()));
                
                foreach ($extras as $character) {
                    $campaign->characters()->attach($character->id, [
                        'user_id' => $character->user_id,
                        'role' => 'player',
                    ]);
                }
            }
        }
    }
}
