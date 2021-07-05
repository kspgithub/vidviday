<?php

namespace App\Models;

use App\Models\Traits\Relationship\DirectionRelationship;
use App\Models\Traits\Scope\UsePublishedScope;
use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * Class Direction
 * Направление тура
 *
 * @package App\Models
 * @mixin IdeHelperDirection
 */
class Direction extends Model
{
    use HasFactory;
    use HasTranslations;
    use UsePublishedScope;
    use DirectionRelationship;
    use UseSelectBox;

    public $translatable = [
        'title',
        'text',
        'seo_h1',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    protected $fillable = [
        'title',
        'seo_h1',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'text',
        'slug',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean'
    ];
}
