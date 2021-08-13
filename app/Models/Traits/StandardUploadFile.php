<?php


namespace App\Models\Traits;

trait StandardUploadFile
{
    /**
     * Saves an image without processing or resizing
     *
     * @param $file
     *
     * @param string $folderStorage the folder in which the image will be stored
     *
     * @return string
     */
    public function storeFile($file, string $folderStorage)
    {

        return $file->store($folderStorage, "public");
    }
}
