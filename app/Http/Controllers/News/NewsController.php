<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Page;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {

        $news = News::published()->orderBy('id', 'desc')->paginate(9);
        $pageContent = Page::where('key', 'news')->first();

        return view("news.index", [
            "pageContent" => $pageContent,
            "news" => $news,
        ]);
    }

    public function single($slug)
    {

        $newsSingle = News::findBySlugOrFail($slug);

        return view("news.single", [
            "newsSingle" => $newsSingle,
        ]);
    }

}
