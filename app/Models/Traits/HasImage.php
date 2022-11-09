<?php

namespace App\Models\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\Html;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Image;

trait HasImage
{

    /**
     * @return string
     */
    public function getImageUrlAttribute(): string
    {
        $logo = $this->getAttributeValue('image');
        $logo_url = asset('/images/no-logo.svg');
        if (!empty($logo)) {
            if (str_starts_with($logo, 'public/')) {
                $logo_url = Storage::url($logo);
            } else {
                $logo_url = $logo;
            }
        }

        return $logo_url;
    }

    /**
     * @param UploadedFile $fileImage
     *
     * @throws InvalidManipulation
     */
    public function uploadImage(UploadedFile $fileImage)
    {
        $date = date('Ymd');
        $path = 'public/' . $fileImage->store("/upload/{$date}", 'public');
        $image_path = Storage::path($path);
        if ($fileImage->getClientMimeType() !== 'image/svg') {
            $size = $this->imageSize();
            Image::load($image_path)->width($size['width'])->height($size['height'])->save();
        }
        $this->image = $path;
        $this->save();
    }

    /**
     *
     */
    public function deleteImage()
    {
        if (!empty($this->image)) {
            Storage::delete($this->image);
        }
    }

    public function imageSize()
    {
        return [
            'width' => 300,
            'height' => 300,
        ];
    }

    public function img(array $attrs = ['loading' => 'lazy'])
    {
        $logo = $this->getAttributeValue('image');
        $path = Storage::path($logo);
        $img = Html::el('img');
        $img->src = $this->image_url;
        $image = Image::load($path);
        $img->width($image->getWidth());
        $img->height($image->getHeight());
        if(array_key_exists('name', $this->attributes)) {
            $img->alt($this->name);
        }
        if(array_key_exists('title', $this->attributes)) {
            $img->alt($this->title);
        }
        foreach ($attrs as $key => $value) {
            $img->setAttribute($key, $value);
        }

        echo $img->render();
    }
}
