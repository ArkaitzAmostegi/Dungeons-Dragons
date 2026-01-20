<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            // Autor de la reseña (no unique)
            $table->string('nombre');

            // Título (corrige tittle -> title)
            $table->string('title')->nullable();

            // Texto de la reseña
            $table->text('descripcion');

            // Nota 1..5
            $table->unsignedTinyInteger('rating')->default(5);

            // Publicable en home
            $table->boolean('is_public')->default(true);

            $table->timestamps();

            // Opcional: index para filtrar rápido en API
            $table->index(['is_public', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
