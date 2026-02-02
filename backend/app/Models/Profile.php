```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    /**
     * Campos permitidos para asignación masiva (create(), update(), fill()).
     */
    protected $fillable = [
        'user_id',
        'nickname',
        'bio',
        'avatar',
    ];

    /**
     * Usuario propietario del perfil (FK: user_id).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```
