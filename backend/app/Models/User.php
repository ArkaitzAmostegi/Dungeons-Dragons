<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Roles disponibles en la app
    const ROLE_ADMIN = 'admin';
    const ROLE_USER  = 'user';

    /**
     * Campos permitidos para asignación masiva (create(), update(), fill()).
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * Campos ocultos al serializar (JSON/arrays).
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Conversión de tipos automática de atributos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Perfil asociado al usuario
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    // Personajes creados por el usuario
    public function characters()
    {
        return $this->hasMany(Character::class);
    }

    // Campañas en las que participa el usuario (pivot campaign_user_character)
    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class, 'campaign_user_character')
            ->withPivot('character_id')
            ->withTimestamps();
    }
}
