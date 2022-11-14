<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Page;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::published()->orderBy('created_at', 'desc')->paginate(9);
        $pageContent = Page::published()->where('key', 'news')->firstOrFail();

        return view('news.index', [
            'pageContent' => $pageContent,
            'news' => $news,
        ]);
    }

    public function single($slug)
    {
        $newsSingle = News::query()->published()->whereHasSlug($slug)->firstOrFail();

        return view('news.single', [
            'newsSingle' => $newsSingle,
        ]);
    }
}
