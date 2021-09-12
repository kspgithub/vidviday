<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {

        $news = $this->query()->latest()
                              ->paginate(9);


        return view("news.index", [
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
