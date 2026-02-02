<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la tabla pivot campaign_user_character para gestionar la participación en campañas:
     * - relaciona campaign, user y character (triple relación)
     * - guarda el rol dentro de la campaña (player, dm, etc.)
     * - evita duplicados con una clave única compuesta
     */
    public function up(): void
    {
        Schema::create('campaign_user_character', function (Blueprint $table) {
            $table->id();

            $table->foreignId('campaign_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('character_id')->constrained()->cascadeOnDelete();

            $table->string('role')->default('player');
            $table->timestamps();

            $table->unique(['campaign_id', 'user_id', 'character_id']);
        });
    }

    /**
     * Elimina la tabla pivot campaign_user_character.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_user_character');
    }
};

