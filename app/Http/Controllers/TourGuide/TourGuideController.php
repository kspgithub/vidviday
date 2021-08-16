<?php

namespace App\Http\Controllers\TourGuide;

use App\Http\Controllers\Controller;
use App\Models\TourGuide;

class TourGuideController extends Controller
{

    public function index()
    {
        //
        $tourGuides = TourGuide::all();

        return view('tour-guide.index', ['tourGuides' => $tourGuides]);
    }
    public function more($id)
    {
        $tourGuides = TourGuide::all()->where('id', $id)->first();
        return view('tour-guide.tour-guide',  ['tourGuides' => $tourGuides]);
    }
}
