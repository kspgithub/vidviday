<?php

namespace App\Models;

use Spatie\MediaLibrary\MediaCollections\Models\Media as SpatieMedia;

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
}
