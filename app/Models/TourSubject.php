<?php

namespace App\Models;

use App\Models\Traits\Methods\HasJsonSlug;
use App\Models\Traits\Scope\UsePublishedScope;
use App\Models\Traits\UseNormalizeMedia;
use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\Traits\HasSlug;
use App\Models\Traits\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class TourSubject extends TranslatableModel implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use HasTranslatableSlug;
    use UsePublishedScope;
    use InteractsWithMedia;
    use UseNormalizeMedia;
    use UseSelectBox;
    use HasJsonSlug;

    public $translatable = [
        'title',
        'text',
        'slug',
        'seo_h1',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'seo_text',
    ];

    protected $fillable = [
        'title',
        'seo_h1',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'seo_text',
        'text',
        'slug',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tours()
    {
        return $this->belongsToMany(Tour::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('normal')
            ->width(840)
            ->height(480);

        $this->addMediaConversion('thumb')
            ->width(315)
            ->height(180);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['id', 'title'])
            //->usingLanguage('uk')
            ->saveSlugsTo('slug');
    }
}
