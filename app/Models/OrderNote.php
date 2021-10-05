<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperOrderNote
 */
class OrderNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'text'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
