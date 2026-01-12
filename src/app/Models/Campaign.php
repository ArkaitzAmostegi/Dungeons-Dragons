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

    public function characters()
    {
        return $this->belongsToMany(Character::class, 'campaign_character')
            ->withPivot('joined_at')
            ->withTimestamps();
    }
}
