```php
<?php

// app/Models/Juego.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juego extends Model
{
    use HasFactory;

    /**
     * Nombre explícito de la tabla (si no coincide con la convención).
     */
    protected $table = 'juegos';

    /**
     * Campos permitidos para asignación masiva (create(), update(), fill()).
     */
    protected $fillable = ['nombre', 'descripcion'];

    /**
     * Campañas que pertenecen a este juego (FK en campaigns: juego_id).
     */
    public function campaigns()
    {
        return $this->hasMany(\App\Models\Campaign::class, 'juego_id');
    }
}
