<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    //Relaciones con tablas use, race, profile y campaign
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'character_profile')
            ->withPivot('role')
            ->withTimestamps();
    }

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class, 'campaign_character')
            ->withPivot('joined_at')
            ->withTimestamps();
    }

}
