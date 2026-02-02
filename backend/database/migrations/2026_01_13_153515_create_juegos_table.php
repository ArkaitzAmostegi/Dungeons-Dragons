<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la tabla juegos para almacenar los modos/juegos disponibles
     * (nombre único y descripción opcional).
     */
    public function up(): void
    {
        Schema::create('juegos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Elimina la tabla juegos.
     */
    public function down(): void
    {
        Schema::dropIfExists('juegos');
    }
};
