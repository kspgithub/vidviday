<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Staff;
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
        $pages = Page::query()->withCount(['media'])->orderBy('title->uk')->get();
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
        $managers = Staff::all()->map->asSelectBox();
        return view('admin.page.create', ['page' => $page, 'managers' => $managers]);
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

        return redirect()->route('admin.page.edit', $page)->withFlashSuccess(__('Record Created'));
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
        $managers = Staff::all()->map->asSelectBox();
        return view('admin.page.edit', ['page' => $page, 'managers' => $managers]);
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

        return redirect()->route('admin.page.edit', $page)->withFlashSuccess(__('Record Updated'));
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

        return redirect()->route('admin.page.index')->withFlashSuccess(__('Record Deleted'));
    }

    public function mediaIndex(Page $page)
    {
        return view('admin.page.media', ['page'=>$page]);
    }
}
