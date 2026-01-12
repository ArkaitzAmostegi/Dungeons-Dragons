<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    //Relación con tabla character
    public function characters()
    {
        return $this->belongsToMany(Character::class, 'campaign_character')
            ->withPivot('joined_at')
            ->withTimestamps();
    }

}
