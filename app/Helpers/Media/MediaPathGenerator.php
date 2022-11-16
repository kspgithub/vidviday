<?php

namespace App\Helpers\Media;

use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class MediaPathGenerator implements PathGenerator
{
    public function getPath(Media $media) : string
    {
        $prefix = 'media/';
        $class_name = explode('\\', $media->model_type);
        if (count($class_name) > 0) {
            $prefix .= Str::lower($class_name[count($class_name) -1]).'/';
        }

        return $prefix.$media->id.'/';
    }

    public function getPathForConversions(Media $media) : string
    {
        return $this->getPath($media) . 'conversions/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media) . 'responsive/';
    }
}
