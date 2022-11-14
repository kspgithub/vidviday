<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Banner;
use App\Models\Page;
use App\Models\PopupAd;
use App\Models\Tour;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index(Request $request)
    {
        $tours = Tour::search()->filter($request->all())->paginate($request->input('per_page', 12));
        $banners = Banner::published()->orderBy('position')->get();
        $achievements = Achievement::published()->get();
        $pageContent = Page::where('key', 'home')->first();
        $popupAds = PopupAd::query()->whereJsonContains('pages', $pageContent->key)->get();

        return view('home.index', [
            'pageContent' => $pageContent,
            'tours' => $tours,
            'banners' => $banners,
            'achievements' => $achievements,
            'popupAds' => $popupAds,
        ]);
    }

    public function testError()
    {
        return 0; //50 / 0;
    }
}
