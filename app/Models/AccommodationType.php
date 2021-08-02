<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

/**
 * @mixin IdeHelperAccommodationType
 */
class AccommodationType extends TranslatableModel
{
    use HasFactory;
    use HasTranslations;
    use HasSlug;

    public $translatable = [
        'description',
    ];


    protected $fillable = [
        'title',
        'slug',
        'description',
    ];


    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title'])
            //->usingLanguage('uk')
            ->saveSlugsTo('slug');
    }
}
