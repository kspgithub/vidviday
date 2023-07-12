<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Banner;
use App\Models\News;
use App\Models\OurClient;
use App\Models\Page;
use App\Models\PopupAd;
use App\Models\Testimonial;
use App\Models\Tour;
use App\Models\TourSchedule;
use App\Services\TourService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\VisualOption;
use Storage;

class HomeController extends Controller
{
    //

    public function index(Request $request)
    {
        $tours = Tour::search()
            ->filter($request->all())
            ->paginate($request->input('per_page', 12));

        $banners = Banner::published()->orderBy('position')->get();
        $achievements = Achievement::published()->get();
        $pageContent = Page::where('key', 'home')->first();
        $popupAds = PopupAd::query()->forModel($pageContent)->get();

        $giftImage = VisualOption::where('key', 'gift_image')->first();

        return view('home.index', [
            'pageContent' => $pageContent,
            'tours' => $tours,
            'banners' => $banners,
            'achievements' => $achievements,
            'popupAds' => $popupAds,
            'giftImage' => $giftImage->value ? Storage::url($giftImage->value) : '/img/gift-certificate.jpg',
        ]);
    }


    public function testError()
    {
        return 0; //50 / 0;
    }
}
