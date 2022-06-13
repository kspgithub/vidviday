<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\LandingPlace;
use App\Models\Tour;
use App\Models\TourLanding;
use Illuminate\Http\Request;

class TourLandingController extends Controller
{
    //

    public function index(Tour $tour)
    {
        return view('admin.tour.landing.index', ['tour' => $tour]);
    }
}
