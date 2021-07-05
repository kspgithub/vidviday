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
     *
     * @throws InvalidManipulation
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     *
     * @return FileAdder|Media
     */
    public function storeMedia($file, ?string $collection = 'default')
    {
        $path = storage_path('tmp/uploads');
        $name = uniqid() . '.' . trim($file->getClientOriginalExtension());
        $file->move($path, $name);
        Image::load($path . '/' . $name)->fit(Manipulations::FIT_MAX, 1920, 1920)->save();
        $media = $this->addMedia($path . '/' . $name)->toMediaCollection($collection);
        @unlink($path . '/' . $name);
        return $media;
    }
}
