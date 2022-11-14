<?php

namespace App\Models;

use App\Models\Traits\HasImage;
use App\Models\Traits\HasSlug;
use App\Models\Traits\Scope\UsePublishedScope;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Achievement extends TranslatableModel
{
    use HasTranslations;
    use HasSlug;
    use UsePublishedScope;
    use HasImage;

    public $translatable = [
        'title',
    ];

    protected $fillable = [
        'title',
        'slug',
        'image',
        'position',
        'published',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title'])
            //->usingLanguage('uk')
            ->saveSlugsTo('slug');
    }

    public function imageSize()
    {
        return [
            'width' => 112,
            'height' => 112,
        ];
    }
}
