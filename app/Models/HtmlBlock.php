<?php

namespace App\Models;

use App\Models\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class HtmlBlock extends TranslatableModel
{
    use HasFactory;
    use HasSlug;
    use HasTranslations;

    public $translatable = [
        'title',
        'text',
    ];

    protected $fillable = [
        'title',
        'text',
        'slug',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title'])
            //->usingLanguage('uk')
            ->saveSlugsTo('slug');
    }
}
