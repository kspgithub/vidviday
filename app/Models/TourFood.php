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

class TourFood extends TranslatableModel
{
    use HasFactory;
    use HasTranslations;
    use UsePublishedScope;

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
        $translations = $this->getTranslations('text');

        return $translations[app()->getLocale()] ?? ($this->time ? $this->time->title . ' у ' . $this->day . '-й день' : '');
    }

    public function getTextAttribute()
    {
        return $this->food->text ?? '';
    }

    public function getTitleAttribute()
    {
        return $this->food->title ?? '';
    }

    public function getMedia()
    {
        return $this->food->getMedia() ?? collect();
    }
}
