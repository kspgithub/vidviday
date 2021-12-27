<?php

namespace App\Models;

use App\Models\Traits\Attributes\EventAttribute;
use App\Models\Traits\Methods\HasJsonSlug;
use App\Models\Traits\Relationship\EventRelationship;
use App\Models\Traits\Scope\UsePublishedScope;
use App\Models\Traits\UseNormalizeMedia;
use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class EventItem extends TranslatableModel implements HasMedia
{
    use HasFactory;
    use HasTranslatableSlug;
    use HasTranslations;
    use UsePublishedScope;
    use InteractsWithMedia;
    use UseNormalizeMedia;
    use EventAttribute;
    use EventRelationship;
    use UseSelectBox;
    use HasJsonSlug;

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('normal')
            ->width(840)
            ->height(480);

        $this->addMediaConversion('thumb')
            ->width(315)
            ->height(180);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('main')
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->singleFile();

        $this->addMediaCollection('pictures')
            ->acceptsMimeTypes(['image/jpeg', 'image/png']);
    }


    public $translatable = [
        'title',
        'text',
        'short_text',
        'slug',
        'seo_h1',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    protected $fillable = [
        'title',
        'text',
        'short_text',
        'slug',
        'seo_h1',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'published',
        'indefinite',
        'start_date',
        'end_date',
    ];

    protected $appends = [
        'url',
    ];

    protected $casts = [
        'published' => 'boolean',
        'indefinite' => 'boolean',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'start_date',
        'end_date',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title'])
            //->usingLanguage('uk')
            ->saveSlugsTo('slug');
    }

    public function getUrlAttribute()
    {
        $slug = $this->slug;
        return !empty($slug) ? route('events.show', $slug) : '';
    }
}
