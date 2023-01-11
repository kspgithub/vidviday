<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsNotification extends Model
{
    protected $fillable = [
        'key',
        'title',
        'text',
        'phone',
        'viber',
    ];
}
