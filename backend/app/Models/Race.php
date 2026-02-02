<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'bonuses',
    ];

    protected $casts = [
        'bonuses' => 'array',
    ];

    public function characters()
    {
        return $this->hasMany(Character::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;

    /**
     * Campos permitidos para asignación masiva (create(), update(), fill()).
     */
    protected $fillable = [
        'name',
        'description',
        'bonuses',
    ];

    /**
     * Convierte automáticamente la columna "bonuses" a array (JSON <-> array).
     */
    protected $casts = [
        'bonuses' => 'array',
    ];

    /**
     * Personajes que pertenecen a esta raza.
     */
    public function characters()
    {
        return $this->hasMany(Character::class);
    }
}
