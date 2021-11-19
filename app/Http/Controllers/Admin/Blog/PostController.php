<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\PostBasicRequest;
use App\Models\Post;
use App\Services\BlogService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $service;

    public function __construct(BlogService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource
     *
     * @return View
     */
    public function index()
    {
        return view("admin.post.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {

        $post = new Post();

        return view("admin.post.create", [
            'post' => $post
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostBasicRequest $request
     *
     * @return RedirectResponse
     */
    public function store(PostBasicRequest $request)
    {

        $news = $this->service->storePost($request->validated());

        return redirect()->route('admin.post.edit', $news)->withFlashSuccess(__('Record Created'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit(Post $post)
    {
        return view('admin.post.edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostBasicRequest $request
     *
     * @param Post $post
     *
     * @return mixed
     *
     * @throws GeneralException
     */
    public function update(PostBasicRequest $request, Post $post)
    {

        $this->service->updatePost($post, $request->validated());

        return redirect()->route('admin.post.edit', $post)->withFlashSuccess(__('Record Updated'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     *
     * @return mixed
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.post.index')->withFlashSuccess(__('Record Deleted'));
    }

    /**
     * Update status the specified resource.
     *
     * @param Request $request
     * @param Post $post
     * @return JsonResponse
     */
    public function updateStatus(Request $request, Post $post)
    {
        $post->published = (int)$request->input('published');
        $post->save();
        return response()->json(['result' => 'success']);
    }
}
