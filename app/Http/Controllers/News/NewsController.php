<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function blog(){

        $blog = News::wherePublished(true)->latest()->paginate();

        return view("news.blog",[
            "blog" => $blog
        ]);
    }

    public function post(){

        return view("news.post",[

        ]);
    }
}
