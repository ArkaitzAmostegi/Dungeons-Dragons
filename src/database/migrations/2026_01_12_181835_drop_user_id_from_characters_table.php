<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('characters', function (Blueprint $table) {
            // si existe FK
            $table->dropForeign(['user_id']);
            // si existe índice unique(['user_id','name'])
            // (si no lo tienes, comenta la línea siguiente)
            // $table->dropUnique(['user_id', 'name']);

            $table->dropColumn('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // si quieres restaurar el unique:
            // $table->unique(['user_id', 'name']);
        });
    }
};
