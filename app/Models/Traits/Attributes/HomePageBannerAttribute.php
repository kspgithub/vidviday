<?php

namespace App\Models\Traits\Attributes;

trait HomePageBannerAttribute
{
    public function getMainImageAttribute()
    {
        $media = $this->getFirstMedia('main');

        return $media === null ? '' : $media->getUrl();
    }

}
