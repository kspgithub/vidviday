<?php

namespace App\Models;

use App\Models\Traits\UseNormalizeMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class TourTransport extends Model implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;
    use UseNormalizeMedia;

    const TYPE_TEMPLATE = 1;
    const TYPE_CUSTOM = 2;

    public $translatable = [
        'text',
        'title',
    ];

    protected $fillable = [
        'tour_id',
        'transport_id',
        'title',
        'text',
        'position',
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

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }

    public function transport(): BelongsTo
    {
        return $this->belongsTo(Transport::class);
    }

//    public function getTextAttribute()
//    {
//        $locale = $this->getLocale();
//        $text = $this->attributes['text'] ?? '';
//        $text = !empty($text) ? json_decode($text, true) : [];
//        return !empty($this->transport) ? $this->transport->text : ($text[$locale] || '');
//    }
//
//    public function getTitleAttribute()
//    {
//        $locale = $this->getLocale();
//        $title = $this->attributes['title'] ?? '';
//        $title = !empty($title) ? json_decode($title, true) : [];
//        $prefix = $title[$locale] ?? ($title['uk'] ?? '');
//        return trim(($this->transport->title ?? '') . ' ' . $prefix);
//    }
}
