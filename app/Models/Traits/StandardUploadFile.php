<?php


namespace App\Models\Traits;

trait StandardUploadFile
{
    /**
     * @param $file
     * @param string $folderStorage
     * @return string
     */
    public function storeFile($file, string $folderStorage)
    {

        return $file->store($folderStorage, "public");
    }
}
