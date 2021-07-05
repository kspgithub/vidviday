<?php

namespace App\Models\Traits;

use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\FileAdder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait UseNormalizeMedia
{
    /**
     * @param string|UploadedFile $file
     * @param string|null $collection
     * @param array $options
     *
     * @throws FileIsTooBig
     * @throws InvalidManipulation
     * @throws FileDoesNotExist
     *
     * @return FileAdder|Media
     */
    public function storeMedia($file, ?string $collection = 'default', array $options = [])
    {
        $path = storage_path('tmp/uploads');
        $name = uniqid() . '.' . trim($file->getClientOriginalExtension());
        $file->move($path, $name);

        $width = $options['width'] ?? 1920;
        $height = $options['height'] ?? 1920;
        $fitMethod = $options['fit'] ?? Manipulations::FIT_MAX;

        Image::load($path . '/' . $name)->fit($fitMethod, $width, $height)->save();

        $media = $this->addMedia($path . '/' . $name)->toMediaCollection($collection);
        @unlink($path . '/' . $name);

        return $media;
    }
}
