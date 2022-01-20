<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Banner;
use App\Models\News;
use App\Models\OurClient;
use App\Models\Page;
use App\Models\Testimonial;
use App\Models\Tour;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    //

    public function index()
    {
        $tours = Tour::search()->paginate(12);
        $banners = Banner::published()->get();
        $achievements = Achievement::published()->get();
        $pageContent = Page::where('key', 'home')->first();

        return view('home.index', [
            'pageContent' => $pageContent,
            'tours' => $tours,
            'banners' => $banners,
            'achievements' => $achievements,
        ]);
    }


    public function testError()
    {
        return 0; //50 / 0;
    }
}
