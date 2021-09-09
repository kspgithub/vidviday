<?php

namespace App\Http\Controllers\TourGuide;

use App\Http\Controllers\Controller;
use App\Models\TourGuide;
use App\Models\Page;

class TourGuideController extends Controller
{

    public function index()
    {
        //
        $tourGuides = TourGuide::all();
        $pageContent = Page::select()->where('id', 3)->get();

        return view('tour-guide.index',
        [
        'tourGuides' => $tourGuides,
        'pageContent'=>$pageContent
        ]);
    }
    public function more($slug)
    {
        $tourGuides = TourGuide::all()->where('slug', $slug)->first();
        return view('tour-guide.tour-guide',  ['tourGuides' => $tourGuides]);
    }
}
