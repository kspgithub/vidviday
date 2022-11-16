<?php


namespace App\Models\Traits;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

trait StandardUploadFile
{
    /**
     * @param $file
     * @param string $folderStorage
     * @return string
     */
    public function storeFile(UploadedFile $file, string $folderStorage)
    {
        return $file->store($folderStorage, "public");
    }
    /**
     * @param $file
     * @param string $folderStorage
     * @return string
     */
    public function storeFileAs($file, string $folderStorage, string $name)
    {
        return $file->storeAs("public/" . $folderStorage, $name);
    }

    /**
     * @param string $file_url
     * @param string $directory
     * @return string|boolean
     */
    public function storeFileFromUrl(string $file_url, string $directory = 'public/uploads/files/')
    {
        $contents = $this->fileGetContents($file_url);
        if ($contents) {
            Storage::makeDirectory($directory);
            $fileName = pathinfo($file_url, PATHINFO_BASENAME);
            $filePath = $directory . $fileName;
            Storage::put($filePath, $contents);
            return Storage::url($filePath);
        }
        return false;
    }


    public function fileGetContents($url)
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

}
