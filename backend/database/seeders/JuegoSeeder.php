```php
<?php

namespace Database\Seeders;

use App\Models\Juego;
use Illuminate\Database\Seeder;

class JuegoSeeder extends Seeder
{
    /**
     * Seeder de "juegos/modos":
     * crea un conjunto base de modos si no existen (evita duplicados con firstOrCreate).
     */
    public function run(): void
    {
        $modos = [
            ['nombre' => 'Atraco', 'descripcion' => 'Planificación, infiltración y escape con botín u objetivo.'],
            ['nombre' => 'Escaramuza', 'descripcion' => 'Combate rápido y táctico contra enemigos o facciones rivales.'],
            ['nombre' => 'Asedio', 'descripcion' => 'Defender o conquistar una fortaleza durante varias fases.'],
            ['nombre' => 'Rescate', 'descripcion' => 'Recuperar un rehén/artefacto antes de que se agote el tiempo.'],
            ['nombre' => 'Exploración', 'descripcion' => 'Descubrir zonas, resolver peligros y avanzar por territorio desconocido.'],
        ];

        foreach ($modos as $modo) {
            Juego::firstOrCreate(['nombre' => $modo['nombre']], $modo);
        }
    }
}
```
