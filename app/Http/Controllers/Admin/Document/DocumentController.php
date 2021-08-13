<?php

namespace App\Http\Controllers\Admin\Document;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Document\DocumentBasicRequest;
use App\Models\Document;
use App\Services\DocumentService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DocumentController extends Controller
{
    protected $service;

    public function __construct(DocumentService $service)
    {
        $this->service = $service;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view("admin.document.index");
    }

    /**
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
     * @param DocumentBasicRequest $request
     * @return mixed
     */
    public function store(DocumentBasicRequest $request)
    {
        $document = $this->service->store($request->validated());

        return redirect()->route('admin.document.index', ["document" => $document])->withFlashSuccess(__('Document created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param Document $document
     * @return Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * @param Document $document
     * @return Application|Factory|View
     */
    public function edit(Document $document)
    {
        return view('admin.document.edit', [
            'document' => $document
        ]);
    }

    /**
     * @param DocumentBasicRequest $request
     * @param Document $document
     * @return mixed
     * @throws GeneralException
     */
    public function update(DocumentBasicRequest $request, Document $document)
    {
        $this->service->update($document, $request->validated());

        return redirect()->route('admin.document.index', $document)->withFlashSuccess(__('Document updated.'));
    }

    /**
     * @param Document $document
     * @return mixed
     */
    public function destroy(Document $document)
    {
        $document->delete();

        return redirect()->route('admin.document.index')->withFlashSuccess(__('Document deleted.'));
    }
}
