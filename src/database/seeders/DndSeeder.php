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
            $profile = $user->profile;

            $chars = Character::factory()
                ->count(rand(2, 4))
                ->create([
                    'user_id' => $user->id,
                    'race_id' => Race::inRandomOrder()->value('id'),
                ]);

            foreach ($chars as $char) {
                $allCharacters->push($char);
            }
        }

        // 3) Crear campañas
        $juegoIds = Juego::pluck('id');
        $campaigns = Campaign::factory()->count(4)->create([
            'juego_id' => fn () => $juegoIds->random(),
            ]);

        // 4) Asignar personajes a campañas (3-6 por campaña)
        foreach ($campaigns as $campaign) {
            $members = $allCharacters->random(rand(3, min(6, $allCharacters->count())));

            foreach ($members as $character) {
                $campaign->characters()->attach($character->id, [
                    'user_id' => $character->user_id,
                    'role' => 'player',
                ]);
            }
        }
    }
}
