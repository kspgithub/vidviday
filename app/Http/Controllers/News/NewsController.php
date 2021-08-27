<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function blog()
    {

        $blog = $this->query()->latest()
                              ->paginate(9);


        return view("news.blog", [
            "blog" => $blog,
        ]);
    }

    public function post($slug)
    {

        $post = $this->query()->whereSlug($slug)
                              ->firstOrFail();

        return view("news.post", [
            "post" => $post,
        ]);
    }

    protected function query()
    {

        return News::query()->wherePublished(true);
    }
}
