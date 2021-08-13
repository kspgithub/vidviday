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

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $htmlBlocks = HtmlBlock::query()->latest()->get();

        return view("admin.html-block.index", [
            "htmlBlocks" => $htmlBlocks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $htmlBlock = new HtmlBlock();

        return view("admin.html-block.create", [
            "htmlBlock" => $htmlBlock
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param HtmlBlockBasicRequest $request
     *
     * @return mixed
     */
    public function store(HtmlBlockBasicRequest $request)
    {
        $htmlBlock = new HtmlBlock();

        $htmlBlock->fill($request->all());
        $htmlBlock->save();

        return redirect()->route('admin.html-block.index', ["htmlBlock" => $htmlBlock])
                         ->withFlashSuccess(__('Record created.'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param HtmlBlock $htmlBlock
     *
     * @return Application|Factory|View
     */
    public function edit(HtmlBlock $htmlBlock)
    {
        return view('admin.html-block.edit', [
            'htmlBlock'=> $htmlBlock
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param HtmlBlockBasicRequest $request
     *
     * @param HtmlBlock $htmlBlock
     *
     * @return mixed
     *
     * @throws GeneralException
     */
    public function update(HtmlBlockBasicRequest $request, HtmlBlock $htmlBlock)
    {
        $htmlBlock->fill($request->all());
        $htmlBlock->save();

        return redirect()->route('admin.html-block.index', $htmlBlock)->withFlashSuccess(__('Record updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param HtmlBlock $htmlBlock
     *
     * @return mixed
     */
    public function destroy(HtmlBlock $htmlBlock)
    {
        $htmlBlock->delete();

        return redirect()->route('admin.html-block.index')->withFlashSuccess(__('Record deleted.'));
    }
}
