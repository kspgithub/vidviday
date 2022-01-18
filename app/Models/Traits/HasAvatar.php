<?php

namespace App\Models\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Image;

trait HasAvatar
{
    /**
     * @return string
     */
    public function getAvatarUrlAttribute(): string
    {
        $avatar = $this->getAttributeValue('avatar');

        if (str_starts_with($avatar, 'http')) {
            return $avatar;
        }
        return !empty($avatar) ? Storage::url($avatar) : asset('/icon/login.svg');
    }

    /**
     * @param UploadedFile $fileImage
     *
     * @throws InvalidManipulation
     */
    public function uploadAvatar(UploadedFile $fileImage)
    {
        $path = 'public/' . $fileImage->store("/user/{$this->id}/avatar", 'public');
        $image_path = Storage::path($path);
        Image::load($image_path)->width(200)->height(200)->save();
        $this->avatar = $path;
        $this->save();
    }

    /**
     *
     */
    public function deleteAvatar()
    {
        if (!empty($this->avatar)) {
            Storage::delete($this->avatar);
        }
    }
}
