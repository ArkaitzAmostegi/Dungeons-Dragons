<?php

// app/Models/Juego.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juego extends Model
{
    use HasFactory;

    protected $table = 'juegos';

    protected $fillable = ['nombre', 'descripcion'];

    public function campaigns()
    {
        return $this->hasMany(Campaign::class, 'juego_id');
    }
}
