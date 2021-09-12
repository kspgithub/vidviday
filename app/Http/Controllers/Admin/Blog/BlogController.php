<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\BlogBasicRequest;
use App\Models\Blog;
use App\Services\BlogService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected BlogService $service;

    public function __construct(BlogService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $blogs = Blog::query()->withCount(['media'])->get();

        return view('admin.blog.index', [
            'blogs' => $blogs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $blog = new Blog();

        return view('admin.blog.create', [
            'blog' => $blog,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BlogBasicRequest $request
     *
     * @return mixed
     */
    public function store(BlogBasicRequest $request)
    {
        $blog = $this->service->store($request->validated());

        return redirect()->route('admin.blog.index', ["blog" => $blog])->withFlashSuccess(__('Record created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Blog $blog
     *
     * @return Application|Factory|View
     */
    public function edit(Blog $blog)
    {
        return view('admin.blog.edit', [
            'blog' => $blog,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BlogBasicRequest $request
     *
     * @param Blog $blog
     *
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     */
    public function update(BlogBasicRequest $request, Blog $blog)
    {
        $this->service->update($blog, $request->validated());

        return redirect()->route('admin.blog.index', $blog)->withFlashSuccess(__('Record updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Blog $blog
     *
     * @return mixed
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('admin.blog.index')->withFlashSuccess(__('Record deleted.'));
    }
}
