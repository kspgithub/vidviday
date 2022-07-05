<?php

namespace App\Http\Controllers\Practice;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Practice;
use Illuminate\Http\Request;

class PracticeController extends Controller
{
    //

    public function index()
    {
        $pageContent = Page::where('key', 'practice')->first();
        $practices = Practice::published()->orderBy('created_at', 'desc')->paginate(20);
        return view('practice.index', [
            'pageContent'=>$pageContent,
            'practices'=>$practices,
        ]);
    }

    public function show($slug)
    {
        $pageContent = Page::where('key', 'practice')->first();
        $practice = Practice::findBySlugOrFail($slug);
        return view('practice.show', [
            'pageContent'=>$pageContent,
            'practice'=>$practice,
        ]);
    }


}