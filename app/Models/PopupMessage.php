<?php

namespace App\Models;

use App\Enums\PopupTypes;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PopupMessage extends Model
{
    use HasTranslations;

    protected $fillable = [
        'type',
        'title',
        'description',
    ];

    protected $translatable = [
        'title',
        'description',
    ];

    protected $casts = [
        'type' => PopupTypes::class,
    ];
}
