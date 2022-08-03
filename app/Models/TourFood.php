<?php

namespace App\Models;

use App\Models\Traits\Scope\JsonLikeScope;
use App\Models\Traits\Scope\UsePublishedScope;
use App\Models\Traits\UseNormalizeMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class TourFood extends TranslatableModel implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use UsePublishedScope;
    use InteractsWithMedia;
    use UseNormalizeMedia;
    use JsonLikeScope;

    const TYPE_TEMPLATE = 1;
    const TYPE_CUSTOM = 2;

    public $translatable = [
        'title',
        'text',
    ];

    public $fillable = [
        'type_id',
        'tour_id',
        'food_id',
        'country_id',
        'region_id',
        'time_id',
        'day',
        'title',
        'text',
        'slug',
        'published',
        'position',
    ];

    protected $appends = [
        'calc_title',
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

    /**
     * @return BelongsTo
     */
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    /**
     * @return BelongsTo
     */
    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    /**
     * @return BelongsTo
     */
    public function time()
    {
        return $this->belongsTo(FoodTime::class);
    }

    /**
     * @return BelongsTo
     */
    public function times()
    {
        return $this->belongsTo(FoodTime::class);
    }

    public function getCalcTitleAttribute()
    {
        $translations = $this->getTranslations('text');

        return $translations[app()->getLocale()] ?? ($this->time ? $this->time->title . ' ' . __('helpers.at_N_day', ['day' => ordinal_number($this->day, app()->getLocale())]) : '');
    }

//    public function getTextAttribute()
//    {
//        return $this->food->text ?? '';
//    }
//
//    public function getTitleAttribute()
//    {
//        return $this->food->title ?? '';
//    }
}
