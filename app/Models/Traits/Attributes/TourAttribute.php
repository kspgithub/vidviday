<?php

namespace App\Models\Traits\Attributes;

trait TourAttribute
{
    protected $tourGuides = null;

    protected $tourManager = null;


    public function getUrlAttribute()
    {
        return !empty($this->slug) ? route('tour.show', $this->slug) : '';
    }


    public function getMainImageAttribute()
    {
        $media = $this->getFirstMedia('main');

        // TODO: Заменить на no image
        return $media === null ? asset('img/no-image.png') : $media->getUrl('thumb');
    }


    public function getMobileImageAttribute()
    {
        $media = $this->getFirstMedia('mobile');

        // TODO: Заменить на no image
        return $media === null ? asset('img/no-image.png') : $media->getUrl();
    }


    public function getTourGuidesAttribute()
    {
        if ($this->tourGuides === null) {
            $this->tourGuides = $this->staff()->onlyExcursionLeaders()->get();
        }
        return $this->tourGuides;
    }

    public function getTourManagerAttribute()
    {
        if ($this->tourManager === null) {
            $this->tourManager = $this->staff()->onlyTourManagers()->first();
        }
        return $this->tourManager;
    }
}
