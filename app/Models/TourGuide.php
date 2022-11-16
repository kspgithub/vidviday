<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class TourGuide extends Model
{
    use HasFactory;
    use HasSlug;
    use HasTranslations;

    public $translatable = [
        'first_name',
        'last_name',
        'title',
        'position',
        'text',
        'seo_title',
        'seo_description',
        'seo_text',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'title',
        'image',
        'position',
        'text',
        'seo_title',
        'seo_description',
        'seo_text',
        'slug',
        'published',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['id', 'title'])
            ->saveSlugsTo('slug');
    }
}
