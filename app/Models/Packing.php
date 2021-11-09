<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * @mixin IdeHelperPacking
 */
class Packing extends TranslatableModel
{
    use HasFactory;
    use HasTranslations;

    public $translatable = [
        'title',
    ];

    protected $fillable = [
        'title',
        'slug',
        'icon',
        'price',
        'currency',
    ];


}
