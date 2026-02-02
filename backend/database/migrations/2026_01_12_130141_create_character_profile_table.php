<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la tabla pivot character_profile para relacionar perfiles y personajes (N:N).
     * Incluye un campo "role" para indicar el tipo de relación (owner/guest/dm, etc.).
     */
    public function up(): void
    {
        Schema::create('character_profile', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained()->cascadeOnDelete();
            $table->foreignId('character_id')->constrained()->cascadeOnDelete();

            $table->string('role')->default('owner');
            $table->timestamps();

            $table->unique(['profile_id', 'character_id']);
        });
    }

    /**
     * Elimina la tabla character_profile.
     */
    public function down(): void
    {
        Schema::dropIfExists('character_profile');
    }
};
