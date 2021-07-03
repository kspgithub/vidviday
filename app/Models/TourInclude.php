<?php

namespace App\Models;

use App\Models\Traits\Scope\UsePublishedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * @mixin IdeHelperTourInclude
 */
class TourInclude extends Model
{
    use HasFactory;
    use HasTranslations;
    use UsePublishedScope;

    public $translatable = [
        'title',
    ];

    protected $fillable = [
        'tour_id',
        'type_id',
        'title',
        'slug',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean'
    ];
}
