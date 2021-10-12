<?php

namespace App\Models;

use App\Models\Traits\Scope\UsePublishedScope;
use App\Models\Traits\UseNormalizeMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

/**
 * Class TourFood
 * Питание тура
 *
 * @package App\Models
 * @mixin IdeHelperTourFood
 */
class TourFood extends TranslatableModel implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;
    use UseNormalizeMedia;
    use UsePublishedScope;

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('normal')
            ->width(840)
            ->height(480);

        $this->addMediaConversion('thumb')
            ->width(315)
            ->height(180);
    }

    public $translatable = [
        'title',
        'text',
    ];

    public $fillable = [
        'tour_id',
        'food_id',
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

    public function getCalcTitleAttribute()
    {
        return $this->time->title . ' у ' . $this->day . '-й день';
    }
}
