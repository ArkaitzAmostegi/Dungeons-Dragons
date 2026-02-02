<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la tabla characters:
     * - cada personaje pertenece a un usuario (dueño) y a una raza
     * - evita que un mismo usuario repita nombres de personaje
     */
    public function up(): void
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('race_id')->constrained()->restrictOnDelete();

            $table->string('name');
            $table->unsignedTinyInteger('level')->default(1);
            $table->string('class')->nullable();
            $table->text('description')->nullable();

            $table->timestamps();

            $table->unique(['user_id', 'name']);
        });
    }

    /**
     * Elimina la tabla characters.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
