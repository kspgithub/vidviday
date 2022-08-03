<?php

namespace App\Models;

use App\Models\Traits\Scope\JsonLikeScope;
use App\Models\Traits\UseNormalizeMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class TourAccommodation extends TranslatableModel implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;
    use UseNormalizeMedia;
    use JsonLikeScope;

    const TYPE_TEMPLATE = 1;
    const TYPE_CUSTOM = 2;

    public $translatable = [
        'text',
        'title',
    ];

    protected $fillable = [
        'type_id',
        'tour_id',
        'accommodation_id',
        'country_id',
        'region_id',
        'city_id',
        'title',
        'text',
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

    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class, 'accommodation_id');
    }

    public function types()
    {
        return $this->belongsToMany(AccommodationType::class, 'tour_accomm_types', 'accomm_id', 'type_id');
    }

//    public function getTextAttribute()
//    {
//        $locale = $this->getLocale();
//        $text = $this->attributes['text'] ?? '';
//        $text = !empty($text) ? json_decode($text, true) : [];
//        return !empty($this->accommodation) ? $this->accommodation->text : ($text[$locale] ?? '');
//    }
//
//    public function getTitleAttribute()
//    {
//        $locale = $this->getLocale();
//        $title = $this->attributes['title'] ?? '';
//        $title = !empty($title) ? json_decode($title, true) : [];
//        return !empty($this->accommodation) ? $this->accommodation->title : ($title[$locale] ?? '');
//    }
}
