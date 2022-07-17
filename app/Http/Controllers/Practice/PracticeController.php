<?php

namespace App\Http\Controllers\Practice;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PopupAd;
use App\Models\Practice;
use Illuminate\Http\Request;

class PracticeController extends Controller
{
    //

    public function index()
    {
        $pageContent = Page::published()->where('key', 'practice')->firstOrFail();
        $practices = Practice::published()->orderBy('created_at', 'desc')->paginate(20);

        $popupAds = PopupAd::query()->whereJsonContains('pages', $pageContent->key)->get();

        return view('practice.index', [
            'pageContent'=>$pageContent,
            'practices'=>$practices,
            'popupAds' => $popupAds,
        ]);
    }

    public function show($slug)
    {
        $pageContent = Page::published()->where('key', 'practice')->firstOrFail();
        $practice = Practice::findBySlugOrFail($slug);
        return view('practice.show', [
            'pageContent'=>$pageContent,
            'practice'=>$practice,
        ]);
    }


}
