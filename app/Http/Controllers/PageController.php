<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function show($slug)
    {
        $pageContent = Page::query()->published()->where('slug', $slug)->firstOrFail();

        return view('page.show', ['pageContent'=>$pageContent]);
    }
}
