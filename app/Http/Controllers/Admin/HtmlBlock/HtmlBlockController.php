<?php

namespace App\Http\Controllers\Admin\HtmlBlock;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\HtmlBlock\HtmlBlockBasicRequest;
use App\Models\HtmlBlock;
use App\Services\HtmlBlockService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HtmlBlockController extends Controller
{
    protected $service;

    public function __construct(HtmlBlockService $service)
    {
        $this->service = $service;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view("admin.html-block.index");
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $htmlBlock = new HtmlBlock();

        return view("admin.html-block.create",[
            "htmlBlock" => $htmlBlock
        ]);
    }

    /**
     * @param HtmlBlockBasicRequest $request
     * @return mixed
     */
    public function store(HtmlBlockBasicRequest $request)
    {
        $htmlBlock = $this->service->store($request->validated());

        return redirect()->route('admin.html-block.index',["htmlBlock" => $htmlBlock])->withFlashSuccess(__('Html Block created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HtmlBlock  $htmlBlock
     * @return \Illuminate\Http\Response
     */
    public function show(HtmlBlock $htmlBlock)
    {

    }

    /**
     * @param HtmlBlock $htmlBlock
     * @return Application|Factory|View
     */
    public function edit(HtmlBlock $htmlBlock)
    {
        return view('admin.html-block.edit', [
            'htmlBlock'=> $htmlBlock
        ]);
    }

    /**
     * @param HtmlBlockBasicRequest $request
     * @param HtmlBlock $htmlBlock
     * @return mixed
     * @throws GeneralException
     */
    public function update(HtmlBlockBasicRequest $request, HtmlBlock $htmlBlock)
    {
        $this->service->update($htmlBlock, $request->validated());

        return redirect()->route('admin.html-block.index', $htmlBlock)->withFlashSuccess(__('Html Block updated.'));
    }

    /**
     * @param HtmlBlock $htmlBlock
     * @return mixed
     */
    public function destroy(HtmlBlock $htmlBlock)
    {
        $htmlBlock->delete();

        return redirect()->route('admin.html-block.index')->withFlashSuccess(__('Html Block deleted.'));
    }
}
