```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    /**
     * Campos permitidos para asignación masiva (create(), update(), fill()).
     */
    protected $fillable = [
        'user_id',
        'race_id',
        'name',
        'level',
        'class',
        'description',
    ];

    /**
     * Raza del personaje (FK: race_id).
     */
    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    /**
     * Campañas en las que participa el personaje.
     * Relación many-to-many mediante la tabla pivot campaign_user_character.
     * En el pivot se guarda quién es el dueño (user_id) y el rol dentro de la campaña (role).
     */
    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class, 'campaign_user_character')
            ->withPivot('user_id', 'role')
            ->withTimestamps();
    }
}
```
