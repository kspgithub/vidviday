<?php

namespace App\Http\Controllers\Practice;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PopupAd;
use App\Models\Practice;
use Illuminate\Http\Request;
use App\Models\VisualOption;
use Storage;

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
            'giftImage' =>  $giftImage->value ? Storage::url($giftImage->value) : '/img/gift-certificate.jpg',
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
        $giftImage = VisualOption::where('key', 'gift_image')->first();
        return view('practice.show', [
            'pageContent'=>$pageContent,
            'practice'=>$practice,
            'giftImage' =>  $giftImage->value ? Storage::url($giftImage->value) : '/img/gift-certificate.jpg',
        ]);
    }


}
