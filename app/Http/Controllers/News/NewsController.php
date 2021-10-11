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

        $news = $this->query()->latest()->paginate(9);
        $pageContent = Page::whereKey('news')->first();

        return view("news.index", [
            "pageContent" => $pageContent,
            "news" => $news,
        ]);
    }

    public function single($slug)
    {

        $newsSingle = $this->query()->whereSlug($slug)
            ->firstOrFail();

        return view("news.single", [
            "newsSingle" => $newsSingle,
        ]);
    }

    protected function query()
    {

        return News::query()->wherePublished(true);
    }
}
