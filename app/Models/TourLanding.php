<?php

namespace App\Models;

use App\Models\Traits\HasTranslatableSlug;
use App\Models\Traits\Scope\JsonLikeScope;
use App\Models\Traits\Scope\UsePublishedScope;
use App\Models\Traits\UseSelectBox;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class TourLanding extends TranslatableModel
{
    use HasTranslations;
    use HasTranslatableSlug;
    use JsonLikeScope;
    use UseSelectBox;
    use UsePublishedScope;

    const TYPE_TEMPLATE = 1;

    const TYPE_CUSTOM = 2;

    protected $table = 'tours_landings';

    public $translatable = [
        'text',
        'title',
        'description',
        'slug',
    ];

    protected $fillable = [
        'tour_id',
        'landing_id',
        'title',
        'description',
        'slug',
        'text',
        'lat',
        'lng',
        'type',
        'time',
    ];

    protected $casts = [
        'lat' => 'float',
        'lng' => 'float',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function landing()
    {
        return $this->belongsTo(LandingPlace::class, 'landing_id');
    }

//    public function getTextAttribute()
//    {
//        $locale = $this->getLocale();
//        $text = $this->attributes['text'] ?? '';
//        $text = !empty($text) ? json_decode($text, true) : [];
//        return !empty($this->landing) ? $this->landing->description : ($text[$locale] ?? '');
//    }
//
//    public function getTitleAttribute()
//    {
//        $locale = $this->getLocale();
//        $title = $this->attributes['title'] ?? '';
//        $title = !empty($title) ? json_decode($title, true) : [];
//        $prefix = $title[$locale] ?? ($title['uk'] ?? '');
//        return trim(($this->landing->title ?? '') . ' ' . $prefix);
//    }
}
