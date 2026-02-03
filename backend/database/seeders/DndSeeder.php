<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Character;
use App\Models\Profile;
use App\Models\Race;
use App\Models\User;
use App\Models\Juego;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DndSeeder extends Seeder
{
    /**
     * Seeder principal de datos “D&D”:
     * - Asegura datos base (razas)
     * - Crea usuarios (incluyendo admins) y sus perfiles
     * - Crea personajes repartidos entre usuarios
     * - Crea campañas y vincula personajes a campañas mediante la tabla pivot (con roles)
     */
    public function run(): void
    {
        // Asegura que existan razas antes de crear personajes
        if (Race::count() === 0) {
            $this->call(RaceSeeder::class);
        }

        // Usuarios predefinidos (players y admins)
        $usersData = [
            ['name' => 'Alice', 'email' => 'alice@example.com', 'password' => 'password', 'role' => User::ROLE_USER, 'is_premium' => true],
            ['name' => 'Bob', 'email' => 'bob@example.com', 'password' => 'password', 'role' => User::ROLE_USER, 'is_premium' => true],
            ['name' => 'Charlie', 'email' => 'charlie@example.com', 'password' => 'password', 'role' => User::ROLE_USER, 'is_premium' => false],
            ['name' => 'Diana', 'email' => 'diana@example.com', 'password' => 'password', 'role' => User::ROLE_USER, 'is_premium' => false],
            ['name' => 'Ethan', 'email' => 'ethan@example.com', 'password' => 'password', 'role' => User::ROLE_USER, 'is_premium' => false],
        ];

        // Crea/actualiza usuarios y asegura que cada uno tenga un perfil
        $users = collect();

        foreach ($usersData as $u) {
            $user = User::updateOrCreate(
                ['email' => $u['email']],
                [
                    'name' => $u['name'],
                    'password' => Hash::make($u['password']),
                    'role' => $u['role'],
                ]
            );

            Profile::updateOrCreate(
                ['user_id' => $user->id],
                ['user_id' => $user->id]
            );

            $users->push($user);
        }

        // Personajes predefinidos; se asignan a los usuarios de forma rotativa
        $charactersData = [
            ['name' => 'Thalion', 'race' => 'Elfo', 'class' => 'Arquero', 'level' => 5, 'description' => 'Un elfo ágil y preciso con el arco.'],
            ['name' => 'Gorim', 'race' => 'Enano', 'class' => 'Guerrero', 'level' => 6, 'description' => 'Enano fuerte y resistente, experto en combate cuerpo a cuerpo.'],
            ['name' => 'Elara', 'race' => 'Humano', 'class' => 'Hechicero', 'level' => 7, 'description' => 'Humana con gran control de la magia elemental.'],
            ['name' => 'Borin', 'race' => 'Enano', 'class' => 'Clérigo', 'level' => 5, 'description' => 'Clérigo devoto, protector del grupo y sanador.'],
            ['name' => 'Lyra', 'race' => 'Elfo', 'class' => 'Bardo', 'level' => 4, 'description' => 'Bardo encantador que inspira a sus aliados.'],
            ['name' => 'Krag', 'race' => 'Orco', 'class' => 'Bárbaro', 'level' => 6, 'description' => 'Orco feroz, siempre al frente de la batalla.'],
            ['name' => 'Seraphina', 'race' => 'Humano', 'class' => 'Paladín', 'level' => 5, 'description' => 'Paladín humano, defensor de los inocentes.'],
            ['name' => 'Fenric', 'race' => 'Mediano', 'class' => 'Pícaro', 'level' => 4, 'description' => 'Sigiloso y astuto, maestro del sigilo y el robo.'],
            ['name' => 'Aelith', 'race' => 'Elfo', 'class' => 'Druida', 'level' => 6, 'description' => 'Druida protector de la naturaleza y los bosques.'],
            ['name' => 'Doran', 'race' => 'Enano', 'class' => 'Guerrero', 'level' => 5, 'description' => 'Guerrero enano, experto en hacha y armadura pesada.'],
            ['name' => 'Isolde', 'race' => 'Humano', 'class' => 'Hechicero', 'level' => 7, 'description' => 'Maga humana que domina hechizos poderosos.'],
            ['name' => 'Thorg', 'race' => 'Orco', 'class' => 'Bárbaro', 'level' => 6, 'description' => 'Orco brutal que ataca sin miedo a los enemigos.'],
            ['name' => 'Lunara', 'race' => 'Elfo', 'class' => 'Bardo', 'level' => 5, 'description' => 'Bardo elfo, inspirador de héroes y cuentacuentos.'],
            ['name' => 'Beldor', 'race' => 'Enano', 'class' => 'Clérigo', 'level' => 5, 'description' => 'Clérigo enano, sanador y sabio.'],
            ['name' => 'Miriel', 'race' => 'Elfo', 'class' => 'Hechicero', 'level' => 6, 'description' => 'Hechicera experta en magia arcana.'],
            ['name' => 'Grimnar', 'race' => 'Orco', 'class' => 'Guerrero', 'level' => 5, 'description' => 'Orco fuerte, siempre listo para la batalla.'],
            ['name' => 'Selene', 'race' => 'Humano', 'class' => 'Druida', 'level' => 6, 'description' => 'Humana que protege la naturaleza y las bestias.'],
            ['name' => 'Fynn', 'race' => 'Mediano', 'class' => 'Pícaro', 'level' => 4, 'description' => 'Mediano ágil y travieso, maestro del sigilo.'],
            ['name' => 'Alaric', 'race' => 'Humano', 'class' => 'Paladín', 'level' => 5, 'description' => 'Paladín humano, defensor de la justicia y el orden.'],
            ['name' => 'Eryndor', 'race' => 'Elfo', 'class' => 'Arquero', 'level' => 5, 'description' => 'Arquero elfo con puntería infalible.'],
        ];

        // Crea personajes y guarda la colección completa para usarlos en campañas
        $allCharacters = collect();
        $userCount = $users->count();

        foreach ($charactersData as $i => $data) {
            $user = $users[$i % $userCount];
            $raceId = Race::where('name', $data['race'])->value('id');

            $character = Character::create([
                'user_id' => $user->id,
                'race_id' => $raceId,
                'name' => $data['name'],
                'level' => $data['level'],
                'class' => $data['class'],
                'description' => $data['description'],
            ]);

            $allCharacters->push($character);
        }

        // Crea campañas con títulos/descriciones predefinidas y asigna participantes
        $juegoIds = Juego::pluck('id');

        $campaignsData = [
            'La Sombra de la Montaña' => 'Un peligro antiguo se oculta entre las cumbres de la montaña.',
            'El Ojo del Dragón' => 'Los dragones vigilan un tesoro que pocos se atreven a buscar.',
            'Los Bosques de Elaria' => 'Bosques encantados llenos de criaturas y misterios.',
            'El Reino Perdido de Tharok' => 'Ruinas de un reino olvidado con secretos por descubrir.',
            'La Maldición de los Elfos Oscuros' => 'Una maldición amenaza a los bosques y a sus habitantes.',
            'El Despertar de los Titanes' => 'Criaturas gigantes resurgen y ponen en peligro el mundo.',
            'La Torre de la Magia Antigua' => 'Una torre antigua custodia hechizos olvidados.',
            'Los Túneles del Submundo' => 'Misteriosos túneles bajo la tierra esconden secretos y peligros.',
            'La Guerra de los Reinos' => 'Conflictos entre reinos que pueden cambiar la historia.',
            'El Laberinto del Guardián' => 'Un laberinto lleno de trampas y enigmas.',
            'Las Ruinas de Arkanis' => 'Ruinas llenas de artefactos mágicos y fantasmas del pasado.',
            'El Valle de las Bestias' => 'Criaturas salvajes dominan un valle oculto.',
            'El Legado del Paladín' => 'Héroes deben continuar la misión de un legendario paladín.',
            'El Trono de Hielo' => 'Un reino helado gobernado por fuerzas misteriosas.',
            'Los Secretos de la Cripta' => 'Criptas antiguas guardan secretos y tesoros olvidados.',
            'La Profecía del Dragón' => 'Una profecía predice la llegada de un dragón poderoso.',
            'El Mar de las Sombras' => 'Un océano peligroso donde lo desconocido acecha.',
            'La Fortaleza del Fénix' => 'Una fortaleza que renace de sus cenizas una y otra vez.',
            'El Asedio de Blackspire' => 'Una ciudad sitiada por enemigos implacables.',
            'El Camino de los Héroes' => 'Héroes deben recorrer un camino lleno de pruebas y desafíos.',
            'El Bosque de los Susurros' => 'Árboles milenarios guardan secretos que solo los valientes descubrirán.',
            'La Ciudad Sumergida' => 'Antigua ciudad bajo el agua, repleta de tesoros y peligros.',
            'El Templo de los Elementos' => 'Un templo perdido donde los elementos se combinan para proteger un gran secreto.',
            'La Cripta de los Eternos' => 'Descubre los secretos de los antiguos guardianes de la cripta.',
            'El Horizonte de Fuego' => 'Volcanes activos amenazan un valle mientras héroes luchan por sobrevivir.',
        ];

        foreach ($users as $user) {
            $myChars = $allCharacters->where('user_id', $user->id)->values();
            if ($myChars->isEmpty()) continue;

            $userCampaigns = $campaignsData;
            $numCampaigns = min(5, count($userCampaigns));

            for ($i = 0; $i < $numCampaigns; $i++) {
                $keys = array_keys($userCampaigns);
                $key = array_rand($keys);
                $title = $keys[$key];
                $description = $userCampaigns[$title];
                unset($userCampaigns[$title]);

                $campaign = Campaign::factory()->create([
                    'juego_id' => fn () => $juegoIds->random(),
                    'title' => $title,
                    'description' => $description,
                ]);

                // Añade un personaje del usuario como owner de la campaña
                $ownerChar = $myChars->random();
                $campaign->characters()->attach($ownerChar->id, [
                    'user_id' => $user->id,
                    'role' => 'owner',
                ]);

                // Añade personajes de otros usuarios como jugadores
                $extraCount = rand(2, 5);
                $extrasPool = $allCharacters->where('user_id', '!=', $user->id)->values();
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
