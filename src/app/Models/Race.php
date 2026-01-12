<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    //Relación con tabla character
    public function characters()
    {
        return $this->hasMany(Character::class);
    }

}
