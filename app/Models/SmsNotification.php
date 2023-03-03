<?php

namespace App\Models;

use App\Models\Traits\Scope\JsonLikeScope;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class SmsNotification extends TranslatableModel
{
    use HasTranslations;
    use JsonLikeScope;

    protected $fillable = [
        'key',
        'title',
        'text',
        'phone',
        'viber',
    ];

    public $translatable = [
        'title',
        'text',
    ];

}
