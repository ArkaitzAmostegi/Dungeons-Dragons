```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la tabla profiles y la relaciona 1:1 con users.
     * - user_id es único para garantizar un perfil por usuario
     * - al borrar el usuario, se borra su perfil (cascadeOnDelete)
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('nickname')->nullable();
            $table->text('bio')->nullable();
            $table->string('avatar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Elimina la tabla profiles.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
```
