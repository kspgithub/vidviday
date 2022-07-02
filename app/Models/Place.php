<?php

namespace App\Models;

use App\Models\Traits\Methods\HasJsonSlug;
use App\Models\Traits\Relationship\PlaceRelationship;
use App\Models\Traits\Scope\JsonLikeScope;
use App\Models\Traits\Scope\UsePublishedScope;
use App\Models\Traits\UseNormalizeMedia;
use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Place extends TranslatableModel implements HasMedia
{
    use HasFactory;
    use HasJsonSlug;
    use UsePublishedScope;
    use HasTranslations;
    use InteractsWithMedia;
    use UseNormalizeMedia;
    use PlaceRelationship;
    use HasTranslatableSlug;
    use UseSelectBox;
    use JsonLikeScope;

    public $translatable = [
        'title',
        'text',
        'seo_h1',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'seo_text',
        'slug',
    ];

    protected $fillable = [
        'title',
        'text',
        'seo_h1',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'seo_text',
        'slug',
        'lat',
        'lng',
        'published',
        'direction_id',
        'country_id',
        'region_id',
        'city_id',
        'district_id',
    ];

    protected $casts = [
        'lat' => 'float',
        'lng' => 'float',
        'published' => 'boolean',
    ];

    protected $appends = [
        'url',
    ];

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
            ->generateSlugsFrom(['title'])
            //->usingLanguage('uk')
            ->saveSlugsTo('slug')
            ->preventOverwrite();
    }


    public function getUrlAttribute()
    {
        return !empty($this->slug) ? '/' . $this->slug : '';
    }


    public function asMapMarker()
    {
        return (object)[
            'title' => $this->title,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'url' => $this->url,
        ];
    }

    public function shortInfo()
    {
        return (object)[
            'id' => $this->id,
            'title' => $this->title,
            'rating' => $this->rating,
            'testimonials_count' => $this->testimonials_count,
            'main_image' => $this->main_image,
            'slug' => $this->slug,
            'url' => $this->url,
        ];
    }

    public function scopeAutocomplete(Builder $query, $search = '')
    {
        $select = [
            'id',
            'district_id',
            'region_id',
            'city_id',
            'title',
            'slug',
        ];
        $with = ['region', 'media'];
        return $query->published()->jsonAutocomplete($search, $select, $with);

    }


    public function asSelectBox($value_key = 'id', $text_key = 'text')
    {
        return [
            $value_key => $this->id,
            $text_key => $this->title . ($this->region ? ' (' . $this->region->title . ($this->district ? ', ' . $this->district->title : '') . ')' : ''),
        ];
    }

    public function getMainImageAttribute()
    {
        $media = $this->getFirstMedia();

        // TODO: Заменить на no image
        return $media === null ? asset('img/no-image.png') : $media->getUrl('thumb');
    }
}
