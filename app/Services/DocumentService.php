<?php

namespace App\Services;

use App\Exceptions\GeneralException;

use App\Models\Document;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        $document->published = 0;

        return $this->update($document, $params);
    }

    public function update(Document $document, array $params = [])
    {
        DB::beginTransaction();

        try {

            if (isset($params['image_upload'])){

                $params["image"] = $document->storeFile($params["image_upload"], "documents");
            }

            $document->fill($params);
            $document->save();

        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            throw new GeneralException(__('There was a problem updating article.'));
        }

        DB::commit();

        return $document;
    }


}
