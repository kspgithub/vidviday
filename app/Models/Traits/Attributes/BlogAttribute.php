<?php

namespace App\Models\Traits\Attributes;

trait BlogAttribute
{
    public function getMainImageAttribute()
    {
        $media = $this->getFirstMedia('main');

        return $media === null ? '' : $media->getUrl();
    }

    public function getMobileImageAttribute()
    {
        $media = $this->getFirstMedia('mobile');

        return $media === null ? '' : $media->getUrl();
    }
}
