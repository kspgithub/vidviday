<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Page;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class BlogController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $blogs = $this->query()->latest()->paginate(9);
        $pageContent = Page::whereKey('news')->first();

        return view("blog.index", [
            "pageContent" => $pageContent,
            "blogs" => $blogs,
        ]);
    }

    /**
     * @param $slug
     * @return Application|Factory|View
     */
    public function single($slug)
    {
        $post = $this->query()->whereSlug($slug)
            ->firstOrFail();

        return view("blog.show", [
            "post" => $post,
        ]);
    }

    protected function query()
    {
        return Blog::query()->wherePublished(true);
    }
}
