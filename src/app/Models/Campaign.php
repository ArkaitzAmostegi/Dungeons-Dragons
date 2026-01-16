<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'modo',
        'status',
        'juego_id',
    ];

    //Relación con User
    public function users()
    {
        return $this->belongsToMany(User::class, 'campaign_user_character')
            ->withPivot('character_id')
            ->withTimestamps();
    }

    //Relación con characters
    public function characters()
    {
        return $this->belongsToMany(Character::class, 'campaign_user_character')
            ->withPivot('user_id')
            ->withTimestamps();
    }

    //Relación con juego
    public function juego()
    {
        return $this->belongsTo(\App\Models\Juego::class, 'juego_id');
    }

    //Relación con campaign-user-character
    public function memberships()
    {
        return $this->hasMany(\App\Models\CampaignUserCharacter::class, 'campaign_id');
    }


}
