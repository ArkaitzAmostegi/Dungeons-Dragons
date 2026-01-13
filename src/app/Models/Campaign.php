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
        'status',
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

}
