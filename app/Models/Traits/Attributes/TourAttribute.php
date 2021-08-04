<?php

namespace App\Models\Traits\Attributes;

trait TourAttribute
{

    public function getUrlAttribute()
    {
        return !empty($this->slug) ? route('tour.show', $this->slug) : '';
    }


    public function getMainImageAttribute()
    {
        $media = $this->getFirstMedia('main');

        // TODO: Заменить на no image
        return $media === null ? asset('img/tour_1.jpg') : $media->getUrl('thumb');
    }


    public function getMobileImageAttribute()
    {
        $media = $this->getFirstMedia('mobile');

        // TODO: Заменить на no image
        return $media === null ? asset('img/tour_1.jpg') : $media->getUrl('thumb');
    }


}
