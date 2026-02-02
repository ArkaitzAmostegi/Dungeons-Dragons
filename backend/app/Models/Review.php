```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * Campos permitidos para asignación masiva (create(), update(), fill()).
     */
    protected $fillable = ['nombre', 'title', 'descripcion', 'rating', 'is_public'];
}
