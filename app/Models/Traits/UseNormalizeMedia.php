<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\File;
use Livewire\TemporaryUploadedFile;
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
     * @param string|UploadedFile|TemporaryUploadedFile $file
     * @param string|null $collection
     * @param array $options
     *
     * @return FileAdder|Media
     * @throws InvalidManipulation
     * @throws FileDoesNotExist
     *
     * @throws FileIsTooBig
     */
    public function storeMedia($file, ?string $collection = 'default', array $options = [])
    {
        $path = storage_path('app/tmp/uploads');
        $name = uniqid() . '.' . trim($file->getClientOriginalExtension());
        if ($file instanceof TemporaryUploadedFile) {
            $file->storeAs('tmp/uploads', $name);
        } else {
            $file->move($path, $name);
        }


        $width = $options['width'] ?? 1920;
        $height = $options['height'] ?? 1920;
        $fitMethod = $options['fit'] ?? Manipulations::FIT_MAX;

        if (File::exists($path . '/' . $name)) {
            Image::load($path . '/' . $name)->fit($fitMethod, $width, $height)->save();
            sleep(1);
            $media = $this->addMedia($path . '/' . $name)->toMediaCollection($collection);
            @unlink($path . '/' . $name);
            return $media;
        }


    }
}
