<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignUserCharacter extends Model
{
    /**
     * Tabla asociada al modelo (pivot “extendido” como modelo).
     */
    protected $table = 'campaign_user_character';

    /**
     * Campos permitidos en asignación masiva (create(), update(), fill()).
     */
    protected $fillable = [
        'campaign_id',
        'user_id',
        'character_id',
        'role',
    ];

    /**
     * Campaña a la que pertenece esta membresía (FK: campaign_id).
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    /**
     * Usuario asociado a esta membresía (FK: user_id).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Personaje asociado a esta membresía (FK: character_id).
     */
    public function character()
    {
        return $this->belongsTo(Character::class);
    }
}
