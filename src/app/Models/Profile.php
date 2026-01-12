<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //Relaciones con tablas User y Character
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function characters()
    {
        return $this->belongsToMany(Character::class, 'character_profile')
            ->withPivot('role')
            ->withTimestamps();
    }

}
