<?php

namespace App\Models\Traits;

use Exception;
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
        $name = md5(uniqid() . rand(0, 100)) . '.' . trim($file->getClientOriginalExtension());
        if ($file instanceof TemporaryUploadedFile) {
            $file->storeAs('tmp/uploads', $name);
        } else {
            $file->move($path, $name);
        }
        $file_name = $path . '/' . $name;

        $width = $options['width'] ?? 1920;
        $height = $options['height'] ?? 1920;
        $fitMethod = $options['fit'] ?? Manipulations::FIT_MAX;

        if (File::exists($file_name)) {
            try {
                $image = Image::load($file_name);
                $image->fit($fitMethod, $width, $height);
                $image->save();
                $media = $this->addMedia($file_name)->toMediaCollection($collection);
                //@unlink($file_name);
                return $media;
            } catch (Exception $e) {

            }

        }


    }
}
