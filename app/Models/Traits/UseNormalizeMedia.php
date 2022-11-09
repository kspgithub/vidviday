<?php

namespace App\Models\Traits;

use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\TemporaryUploadedFile;
use Nette\Utils\Html;
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
        $original_extension = $file->getClientOriginalExtension();
        $original_name = Str::slug(str_replace('.' . $original_extension, '', $file->getClientOriginalName()));
        $tmpName = md5(uniqid() . rand(0, 100)) . '.' . trim($file->getClientOriginalExtension());
        $name = $original_name . '.' . trim($original_extension);
        if ($file instanceof TemporaryUploadedFile) {
            $file->storeAs('tmp/uploads', $tmpName);
        } else {
            $file->move($path, $tmpName);
        }
        $file_name = $path . '/' . $tmpName;

        $width = $options['width'] ?? 1920;
        $height = $options['height'] ?? 1920;
        $fitMethod = $options['fit'] ?? Manipulations::FIT_MAX;

        if (File::exists($file_name)) {
            try {
                $image = Image::load($file_name);
                $image->fit($fitMethod, $width, $height);
                $image->save();
                $media = $this->addMedia($file_name)->usingName($original_name)->usingFileName($name)->toMediaCollection($collection);
                @unlink($file_name);
                return $media;
            } catch (Exception $e) {
                Log::error($e->getMessage());
            }

        }

        return null;
    }

    public function img(Media|string $source, string $conversion = '', array $attrs = [], array $options = [])
    {
        if (is_string($source)) {
            $media = $this->getFirstMedia($source);
        }

        $image = Image::load($media->getPath($conversion));

        $img = Html::el('img');
        $img->src($media->getUrl($conversion));

        if (file_exists($media->getPath($conversion))) {
            $img->width($image->getWidth());
            $img->height($image->getHeight());
        }

        if (array_key_exists('name', $this->attributes)) {
            $img->alt($this->name);
        }
        if (array_key_exists('title', $this->attributes)) {
            $img->alt($this->title);
        }

        if ($options['lazy'] ?? false) {
            $img->setAttribute('loading', 'lazy');
            $img->setAttribute('data-img-src', $img->src);
//            $img->srcset($media->getUrl($conversion));
            $img->src(asset('img/preloader.png'));
        }

        foreach ($attrs as $key => $value) {
            $img->setAttribute($key, $value);
        }

        return $img->render();
    }
}
