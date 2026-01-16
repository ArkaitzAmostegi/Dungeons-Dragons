<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignUserCharacter extends Model
{
    protected $table = 'campaign_user_character';

    protected $fillable = [
        'campaign_id',
        'user_id',
        'character_id',
        'role',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function character()
    {
        return $this->belongsTo(Character::class);
    }
}
