<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Elimina la tabla pivot character_profile (limpieza de modelo/relación que ya no se usa).
     * Se usa dropIfExists para que no falle si la tabla no existe.
     */
    public function up(): void
    {
        Schema::dropIfExists('character_profile');
    }

    /**
     * Revierte el cambio recreando la tabla character_profile.
     */
    public function down(): void
    {
        Schema::create('character_profile', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained()->cascadeOnDelete();
            $table->foreignId('character_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }
};
