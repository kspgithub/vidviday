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
use App\Models\Traits\HasSlug;
use App\Models\Traits\HasTranslatableSlug;
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
        'video',
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
        return url(!empty($this->slug) ? '/' . $this->slug : '');
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

    public function asExportPlace()
    {
        return [
            'title' => $this->getTranslations('title'),
            'text' => $this->getTranslations('text'),
            'lat' => $this->lat,
            'lng' => $this->lng,
            'video' => $this->video,
            'rating' => $this->rating,
            'country' => $this->country->getTranslations('title'),
            'region' => $this->region->getTranslations('title'),
            'district' => $this->district->getTranslations('title'),
            'city' => $this->city->getTranslations('title'),
            'direction' => $this->direction->getTranslations('title'),
            'images' => $this->getMedia()->map(fn($it) => $it->getFullUrl()),
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


    public function asSelectBox($value_key = 'id', $text_key = 'text', $titleSource = 'default', $appendUrl = false)
    {
        $title = $titleSource === 'default' ? $this->title . ($this->region ? ' (' . $this->region->title . ($this->district ? ', ' . $this->district->title : '') . ')' : '') : $this->{$titleSource};
        $data = [
            $value_key => $this->id,
            $text_key => $title,
        ];
        if ($appendUrl) {
            $data['url'] = $this->getUrlAttribute();
        }
        return $data;
    }

    public function getMainImageAttribute()
    {
        $media = $this->getFirstMedia();

        // TODO: Заменить на no image
        return $media === null ? asset('img/no-image.png') : $media->getUrl('thumb');
    }
}
