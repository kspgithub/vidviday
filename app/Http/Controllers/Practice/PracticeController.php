<?php

namespace App\Http\Controllers\Practice;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PopupAd;
use App\Models\Practice;
use Illuminate\Http\Request;
use App\Models\VisualOption;

class PracticeController extends Controller
{
    //

    public function index(Request $request)
    {
        $pageContent = Page::published()->where('key', 'practice')->firstOrFail();
        $practices = Practice::published()->orderBy('created_at', 'desc')->paginate(20);
        $popupAds = PopupAd::query()->forModel($pageContent)->get();
        $giftImage = VisualOption::where('key', 'gift_image')->first();

        return view('practice.index', [
            'pageContent'=>$pageContent,
            'practices'=>$practices,
            'popupAds' => $popupAds,
            'giftImage' => $giftImage,
        ]);
    }

    public function show($slug)
    {
        $pageContent = Page::published()->where('key', 'practice')->firstOrFail();
        if(is_numeric($slug)) {
            $practice = Practice::findOrFail($slug);
        } else {
            $practice = Practice::findBySlugOrFail($slug);
        }
        return view('practice.show', [
            'pageContent'=>$pageContent,
            'practice'=>$practice,
        ]);
    }


}
