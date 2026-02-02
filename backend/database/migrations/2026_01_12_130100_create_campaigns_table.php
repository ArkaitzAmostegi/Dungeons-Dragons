<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la tabla campaigns para guardar las campañas/partidas.
     * Incluye un estado (activa o finalizada) para separar partidas en curso del historial.
     */
    public function up(): void
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'finished'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Elimina la tabla campaigns.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
