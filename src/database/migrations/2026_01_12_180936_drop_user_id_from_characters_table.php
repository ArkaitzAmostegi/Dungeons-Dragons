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
        Schema::table('characters', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropUnique(['user_id', 'name']); // si la pusiste
            $table->dropColumn('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unique(['user_id', 'name']);
        });
    }

};
