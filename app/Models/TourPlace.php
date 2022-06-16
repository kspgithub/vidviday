<?php

namespace App\Models;

use App\Models\Traits\UseNormalizeMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class TourPlace extends TranslatableModel implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;
    use UseNormalizeMedia;

    const TYPE_TEMPLATE = 1;
    const TYPE_CUSTOM = 2;

    public $timestamps = false;

    protected $table = 'tours_places';

    public $translatable = [
        'text',
        'title',
        'slug',
    ];

    protected $fillable = [
        'type_id',
        'tour_id',
        'place_id',
        'country_id',
        'region_id',
        'district_id',
        'city_id',
        'direction_id',
        'title',
        'text',
        'slug',
        'lat',
        'lng',
        'video',
        'rating',
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

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }

//    public function getTextAttribute()
//    {
//        $locale = $this->getLocale();
//        $text = $this->attributes['text'] ?? '';
//        $text = !empty($text) ? json_decode($text, true) : [];
//        return !empty($this->place) ? $this->place->text : ($text[$locale] ?? '');
//    }
//
//    public function getTitleAttribute()
//    {
//        $locale = $this->getLocale();
//        $title = $this->attributes['title'] ?? '';
//        $title = !empty($title) ? json_decode($title, true) : [];
//        $prefix = $title[$locale] ?? ($title['uk'] ?? '');
//        return trim(($this->place->title ?? '') . ' ' . $prefix);
//    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function direction()
    {
        return $this->belongsTo(Direction::class);
    }
}
