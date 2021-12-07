<?php

namespace App\Models;

use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

/**
 * Class IncludeType
 *
 * @package App\Models
 * @mixin IdeHelperIncludeType
 */
class IncludeType extends TranslatableModel
{
    use HasTranslations;
    use UseSelectBox;
    use HasSlug;

    public $translatable = [
        'title',
    ];

    protected $fillable = [
        'title',
        'slug',
    ];

    /**
     * @return HasMany
     */
    public function tourIncludes()
    {
        return $this->hasMany(TourInclude::class);
    }


    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title'])
            //->usingLanguage('uk')
            ->saveSlugsTo('slug');
    }
}
