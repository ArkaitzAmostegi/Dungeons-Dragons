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

    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class, 'campaign_character')
            ->withPivot('joined_at')
            ->withTimestamps();
    }
}
