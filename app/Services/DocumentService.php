<?php

namespace App\Services;

use App\Exceptions\GeneralException;

use App\Models\Document;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Spatie\Image\Manipulations;

class DocumentService extends BaseService
{
    /**
     * UserService constructor.
     *
     * @param Document $document
     */
    public function __construct(Document $document)
    {
        $this->model = $document;
    }

    public function store($params)
    {
        $document = new Document();
        $document->published = 1;

        return $this->update($document, $params);
    }

    public function update(Document $document, array $params = [])
    {
        try {
            if (isset($params['file_upload'])) {
                $params["mime_type"] = $params['file_upload']->getMimeType();

                $baseName = Str::random();

                $fileName = $baseName.'.'.$params["file_upload"]->getClientOriginalExtension();

                $params["file"] = $fileName;

                $params["url"] = $document->storeFile($params["file_upload"], $fileName, "documents");
            }

            $document->fill($params);
            $document->save();
        } catch (Exception $e) {
            throw new GeneralException(__('There was a problem updating document.'));
        }

        return $document;
    }
}
