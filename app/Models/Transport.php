<?php

namespace App\Models;

use App\Models\Traits\HasImage;
use App\Models\Traits\Scope\UsePublishedScope;
use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Transport extends TranslatableModel
{
    use HasFactory;
    use HasTranslations;
    use UsePublishedScope;
    use HasImage;
    use HasSlug;
    use UseSelectBox;

    public $translatable = [
        'title',
        'text',
    ];

    protected $fillable = [
        'title',
        'text',
        'slug',
        'published',
        'image',
    ];

    protected $casts = [
        'published' => 'boolean'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title'])
            //->usingLanguage('uk')
            ->saveSlugsTo('slug');
    }
}
