<?php

namespace App\Models\Traits\Attributes;

trait PostAttribute
{
    public function getMainImageAttribute()
    {
        $media = $this->getFirstMedia('main');

        return $media === null ? '' : $media->getUrl('thumb');
    }

    public function getMobileImageAttribute()
    {
        $media = $this->getFirstMedia('mobile');

        return $media === null ? '' : $media->getUrl();
    }

    public function getMainImageUrlAttribute()
    {
        $image = $this->getMainImageAttribute();
        return $image ?: asset('img/no-image.png');
    }

    public function getMobileImageUrlAttribute()
    {
        $image = $this->getMobileImageAttribute();
        return $image ?: asset('img/no-image.png');
    }
}
