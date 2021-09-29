<?php


namespace App\Models\Traits\Attributes;

trait BlogAttribute
{
    public function getMainImageAttribute()
    {
        $media = $this->getFirstMedia('main');

        return $media === null ? asset('img/no-image.png') : $media->getUrl('thumb');
    }

    public function getMobileImageAttribute()
    {
        $media = $this->getFirstMedia('mobile');

        return $media === null ? '' : $media->getUrl();
    }
}
