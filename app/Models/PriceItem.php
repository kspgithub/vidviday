<?php

namespace App\Models;

use App\Models\Traits\Scope\UsePublishedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * @mixin IdeHelperPriceItem
 */
class PriceItem extends Model
{
    use HasFactory;
    use HasTranslations;
    use UsePublishedScope;

    public $translatable = [
        'title',
    ];

    protected $fillable = [
        'title',
        'limited',
        'places',
        'price',
        'currency',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean'
    ];
}
