<?php


namespace App\Models\Traits;


trait StandardUploadFile
{
    /**
     * @param $file
     * @param string $folderStorage
     * @return string
     */
    public function storeFile($file, string $file_name, string $folderStorage){

        return $file->storeAs($folderStorage, $file_name);
    }
}
