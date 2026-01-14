<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'race_id',
        'name',
        'level',
        'class',
        'description',
    ];

    //Relación con race
    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    //Rerlación con campaigns
    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class, 'campaign_user_character')
            ->withPivot('user_id', 'role')
            ->withTimestamps();
    }

}
