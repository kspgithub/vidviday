<?php

namespace App\Http\Controllers\Admin\Document;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Document\DocumentBasicRequest;
use App\Models\Document;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class DocumentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view("admin.document.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $document = new Document();

        return view("admin.document.create", [
            "document" => $document
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DocumentBasicRequest $request
     *
     * @return mixed
     */
    public function store(DocumentBasicRequest $request)
    {
        $document = new Document();

        $params = $request->all();

        if (!is_null($request->get('image_upload'))) {
            $params["image"] = $document->storeFile($params["image_upload"], "documents");
        }

        $document->fill($params);

        $document->save();

        return redirect()->route('admin.document.index', ["document" => $document])
                         ->withFlashSuccess(__('Record created.'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Document $document
     *
     * @return Application|Factory|View
     */
    public function edit(Document $document)
    {
        return view('admin.document.edit', [
            'document'=> $document
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DocumentBasicRequest $request
     *
     * @param Document $document
     *
     * @return mixed
     *
     * @throws GeneralException
     */
    public function update(DocumentBasicRequest $request, Document $document)
    {
        $params = $request->all();

        if (!is_null($request->get('image_upload'))) {
            $params["image"] = $document->storeFile($params["image_upload"], "documents");
        }

        $document->fill($params);

        $document->save();

        return redirect()->route('admin.document.index', $document)->withFlashSuccess(__('Record updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Document $document
     *
     * @return mixed
     */
    public function destroy(Document $document)
    {
        $document->delete();

        return redirect()->route('admin.document.index')->withFlashSuccess(__('Record deleted.'));
    }
}
