<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la tabla races para almacenar razas (nombre único) y sus bonificaciones en JSON.
     */
    public function up(): void
    {
        Schema::create('races', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->json('bonuses')->nullable(); // Ej: {"str":1,"dex":2}
            $table->timestamps();
        });
    }

    /**
     * Elimina la tabla races.
     */
    public function down(): void
    {
        Schema::dropIfExists('races');
    }
};
