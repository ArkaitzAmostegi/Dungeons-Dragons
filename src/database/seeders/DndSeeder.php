<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Character;
use App\Models\Profile;
use App\Models\Race;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

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
            ->create()
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

            // Relación pivot profile <-> character (role owner)
            foreach ($chars as $char) {
                $profile->characters()->attach($char->id, ['role' => 'owner']);
                $allCharacters->push($char);
            }
        }

        // 3) Crear campañas
        $campaigns = Campaign::factory()->count(4)->create(['status' => 'active']);

        // 4) Asignar personajes a campañas (3-6 por campaña)
        foreach ($campaigns as $campaign) {
            $members = $allCharacters->random(rand(3, min(6, $allCharacters->count())));

            foreach ($members as $character) {
                $campaign->characters()->attach($character->id, [
                    'joined_at' => Carbon::now()->subDays(rand(0, 60)),
                ]);
            }
        }
    }
}
