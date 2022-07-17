<?php

namespace App\Http\Controllers\Blog;

use App\Models\Post;
use App\Models\Page;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {

        $posts = Post::published()->orderBy('id', 'desc')->paginate(9);
        $pageContent = Page::published()->where('key', 'blog')->firstOrFail();

        return view('blog.index', [
            'pageContent' => $pageContent,
            'posts' => $posts,
        ]);
    }

    /**
     * @param $slug
     * @return View
     */
    public function post($slug)
    {
        $post = Post::findBySlugOrFail($slug);

        return view('blog.post', [
            'post' => $post,
        ]);
    }

}
