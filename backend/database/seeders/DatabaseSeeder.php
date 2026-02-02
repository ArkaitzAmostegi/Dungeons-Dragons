<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seeder principal: ejecuta los seeders del proyecto en orden.
     */
    public function run(): void
    {
        $this->call([
            RaceSeeder::class,   // Crea razas base
            JuegoSeeder::class,  // Crea modos/juegos disponibles
            DndSeeder::class,    // Carga datos principales del proyecto (campañas/personajes/relaciones)
            ReviewSeeder::class, // Crea reseñas para la landing
        ]);
    }
}
