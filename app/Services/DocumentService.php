<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Models\Document;
use Exception;
use Illuminate\Support\Facades\Storage;

class DocumentService extends BaseService
{
    /**
     * UserService constructor.
     *
     * @param  Document  $document
     */
    public function __construct(Document $document)
    {
        $this->model = $document;
    }

    public function store($params)
    {
        $document = new Document();

        return $this->update($document, $params);
    }

    public function update(Document $document, array $params = [])
    {
        try {
            if (isset($params['file_upload'])) {
                $params['file'] = Storage::url($document->storeFile($params['file_upload'], 'uploads/files'));
            }
            if (isset($params['image_upload'])) {
                $params['image'] = Storage::url($document->storeFile($params['image_upload'], 'uploads/files'));
            }
            $document->fill($params);
            $document->save();
        } catch (Exception $e) {
            throw new GeneralException(__('There was a problem updating document.'));
        }

        return $document;
    }
}
