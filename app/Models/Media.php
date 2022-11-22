<?php

namespace App\Models;

use Spatie\MediaLibrary\MediaCollections\Models\Media as SpatieMedia;

class Media extends SpatieMedia
{
    protected $appends = [
        'title',
        'alt',
    ];

    public function getDimensions()
    {

    }

    public function toSwiperSlide()
    {
        return self::asSwiperSlide($this);
    }

    public static function asSwiperSlide(SpatieMedia $media)
    {
        $locale = app()->getLocale();
        $item = [
            'id' => $media->id,
            'url' => $media->getUrl(),
            'thumb' => $media->getUrl('thumb'),
            'alt' => $media->getCustomProperty('alt_' . $locale) ?? $media->model->title,
            'title' => $media->getCustomProperty('title_' . $locale) ?? $media->model->title,
        ];
        return (object)$item;
    }


    public function asAlpineData()
    {
        $alts = [];
        $titles = [];
        foreach (siteLocales() as $locale) {
            $alts[$locale] = $this->getCustomProperty('alt_' . $locale) ?? '';
            $titles[$locale] = $this->getCustomProperty('title_' . $locale) ?? '';
        }
        return [
            'id' => $this->id,
            'url' => $this->getUrl(),
            'thumb' => $this->getUrl('thumb'),
            'alt' => $alts,
            'title' => $titles,
            'published' => $this->getCustomProperty('published'),
        ];
    }

    public function getTitleAttribute()
    {
        return $this->getCustomProperty('title_' . app()->getLocale()) ?? $this->getCustomProperty('title_uk');
    }

    public function getAltAttribute()
    {
        return $this->getCustomProperty('alt_' . app()->getLocale()) ?? $this->getCustomProperty('alt_uk');
    }
}
