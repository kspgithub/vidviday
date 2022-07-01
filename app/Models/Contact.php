<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Contact extends TranslatableModel
{
    use HasTranslations;

    public $translatable = [
        'title',
        'address',
        'address_comment',
        'map_comment',
        'opening_hours',
    ];

    protected $fillable = [
        'title',
        'address',
        'address_comment',
        'map_comment',
        'opening_hours',
        'lat',
        'lng',
        'email',
        'work_phone',
        'phone_1',
        'phone_2',
        'phone_3',
        'skype',
        'viber',
        'telegram',
        'whatsapp',
        'messenger',
    ];
}
