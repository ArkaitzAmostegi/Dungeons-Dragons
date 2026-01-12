<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'bonuses',
    ];

    protected $casts = [
        'bonuses' => 'array',
    ];

    public function characters()
    {
        return $this->hasMany(Character::class);
    }
}
