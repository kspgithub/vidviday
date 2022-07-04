<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Staff;
use App\Rules\TranslatableSlugRule;
use App\Rules\UniqueSlugRule;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
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
        $pages = Page::query()->withCount(['media', 'recommendations'])->orderBy('title->uk')->get();
        //
        return view('admin.page.index', ['pages' => $pages]);
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
     * @return Response|RedirectResponse
     */
    public function store(Request $request)
    {
        //
        $params = $request->all();
        $validator = Validator::make($params, [
            'title' => ['required', 'array'],
            'title.uk' => ['required'],
            'title.ru' => ['required'],
            'title.en' => ['required'],
            'title.pl' => ['required'],
            'key' => ['required', 'unique:pages'],
            'slug' => ['required', 'array', new TranslatableSlugRule()],
            'slug.uk' => ['required', new UniqueSlugRule('pages', 'slug')],
            'slug.ru' => ['required', new UniqueSlugRule('pages', 'slug')],
            'slug.en' => ['required', new UniqueSlugRule('pages', 'slug')],
            'slug.pl' => ['required', new UniqueSlugRule('pages', 'slug')],
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($params);
        }

        $page = new Page();
        $page->fill($params);
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
     * @return Response|RedirectResponse
     */
    public function update(Request $request, Page $page)
    {
        //
        $params = $request->all();
        $validator = Validator::make($params, [
            'title' => ['required', 'array'],
            'title.uk' => ['required'],
            'title.ru' => ['required'],
            'title.en' => ['required'],
            'title.pl' => ['required'],
            'slug' => ['required', 'array', new TranslatableSlugRule()],
            'slug.uk' => ['required', new UniqueSlugRule('pages', 'slug', $page->id)],
            'slug.ru' => ['required', new UniqueSlugRule('pages', 'slug', $page->id)],
            'slug.en' => ['required', new UniqueSlugRule('pages', 'slug', $page->id)],
            'slug.pl' => ['required', new UniqueSlugRule('pages', 'slug', $page->id)],
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.page.edit', $page)->withErrors($validator);
        }

        $page->fill($params);
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
}
