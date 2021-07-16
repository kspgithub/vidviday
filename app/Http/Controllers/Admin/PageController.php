<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $pages = Page::query()->withCount(['media'])->get();
        //
        return view('admin.page.index', ['pages'=>$pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        //
        $page = new Page();

        return view('admin.page.create', ['page'=>$page]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $page = new Page();
        $page->fill($request->all());
        $page->save();

        return redirect()->route('admin.page.index')->withFlashSuccess(__('Page created.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Page $page
     *
     * @return View
     */
    public function edit(Page $page)
    {
        //
        return view('admin.page.edit', ['page'=>$page]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Page $page
     *
     * @return Response
     */
    public function update(Request $request, Page $page)
    {
        //
        $page->fill($request->all());
        $page->save();

        return redirect()->route('admin.page.index')->withFlashSuccess(__('Page updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Page $page
     *
     * @return Response
     */
    public function destroy(Page $page)
    {
        //
        $page->delete();

        return redirect()->route('admin.page.index')->withFlashSuccess(__('Page deleted.'));
    }

    public function mediaIndex(Page $page)
    {
        return view('admin.page.media', ['page'=>$page]);
    }

    public function mediaUpload(Request $request, Page $page)
    {
        if ($request->hasFile('media_file')) {
            $media = $page->storeMedia($request->file('media_file'));

            return response()->json(['result'=>'success', 'media'=>[
                'id'=>$media->id,
                'url'=>$media->getUrl(),
                'thumb'=>$media->getUrl('thumb'),
            ]]);
        }

        return response()->json(['result'=>'error', 'message'=>'No file'], 400);
    }

    public function mediaUpdate(Request $request, Page $page, Media $media)
    {
        if ($request->has('title')) {
            $media->setCustomProperty('title_'.app()->getLocale(), $request->input('title', ''));
        }
        if ($request->has('alt')) {
            $media->setCustomProperty('alt_'.app()->getLocale(), $request->input('alt', ''));
        }
        $media->save();

        return response()->json(['result'=>'success', 'media'=>$media]);
    }

    public function mediaRemove(Page $page, Media $media)
    {
        $page->deleteMedia($media);

        return response()->json(['result'=>'success', 'media'=>$media]);
    }
}
