<?php

namespace App\Models;

use Spatie\MediaLibrary\MediaCollections\Models\Media as SpatieMedia;

/**
 * @mixin IdeHelperMedia
 */
class Media extends SpatieMedia
{
    public function toSwiperSlide()
    {
        return self::asSwiperSlide($this);
    }

    public static function asSwiperSlide(SpatieMedia $media)
    {
        $locale = app()->getLocale();
        $conversions = $media->getMediaConversionNames();
        $item = [
            'id' => $media->id,
            'url' => $media->getUrl(),
            'alt' => $media->getCustomProperty('alt_' . $locale) ?? $media->model->title,
            'title' => $media->getCustomProperty('title_' . $locale) ?? $media->model->title,
        ];
        foreach ($conversions as $conversion) {
            $item[$conversion] = $media->getUrl($conversion);
        }

        return (object)$item;
    }


    protected $appends = [
        'title',
        'alt',
    ];

    public function getTitleAttribute()
    {
        return $this->getCustomProperty('alt_' . app()->getLocale()) ?? $this->getCustomProperty('alt_uk');
    }

    public function getAltAttribute()
    {
        return $this->getCustomProperty('title_' . app()->getLocale()) ?? $this->getCustomProperty('title_uk');
    }
}
