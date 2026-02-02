<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    /**
     * Campos que se pueden asignar masivamente (create(), update(), fill()).
     */
    protected $fillable = [
        'title',
        'description',
        'modo',
        'status',
        'juego_id',
    ];

    /**
     * Usuarios que participan en la campaña.
     * Relación many-to-many usando la tabla pivot: campaign_user_character.
     * En el pivot se guarda también el character_id asociado a esa participación.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'campaign_user_character')
            ->withPivot('character_id')
            ->withTimestamps();
    }

    /**
     * Personajes que participan en la campaña.
     * Relación many-to-many usando la tabla pivot: campaign_user_character.
     * En el pivot se guarda también el user_id dueño de ese personaje en la campaña.
     */
    public function characters()
    {
        return $this->belongsToMany(Character::class, 'campaign_user_character')
            ->withPivot('user_id')
            ->withTimestamps();
    }

    /**
     * Juego/modo de juego asociado a la campaña (FK: juego_id).
     */
    public function juego()
    {
        return $this->belongsTo(\App\Models\Juego::class, 'juego_id');
    }

    /**
     * Entradas del pivot como modelo (CampaignUserCharacter).
     * Útil para consultar membresías con más detalle (user, character, etc.).
     */
    public function memberships()
    {
        return $this->hasMany(\App\Models\CampaignUserCharacter::class, 'campaign_id');
    }
}
