<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_juego_id_to_campaigns_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // 1) Añadir columna nullable primero
        Schema::table('campaigns', function (Blueprint $table) {
            $table->foreignId('juego_id')->nullable()->after('id');
        });

        // 2) Rellenar campañas existentes con un juego válido (el primero)
        $firstJuegoId = DB::table('juegos')->orderBy('id')->value('id');

        // Si no hay juegos aún, crea uno mínimo para que exista id
        if (!$firstJuegoId) {
            $firstJuegoId = DB::table('juegos')->insertGetId([
                'nombre' => 'Exploración',
                'descripcion' => 'Descubrir zonas, resolver peligros y avanzar por territorio desconocido.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::table('campaigns')->whereNull('juego_id')->update(['juego_id' => $firstJuegoId]);

        // 3) Añadir FK
        Schema::table('campaigns', function (Blueprint $table) {
            $table->foreign('juego_id')->references('id')->on('juegos')->restrictOnDelete();
        });

        // 4) (Opcional) hacerlo NOT NULL al final
        Schema::table('campaigns', function (Blueprint $table) {
            $table->foreignId('juego_id')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropForeign(['juego_id']);
            $table->dropColumn('juego_id');
        });
    }
};
