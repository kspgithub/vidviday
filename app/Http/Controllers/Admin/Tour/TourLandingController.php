<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;

class TourLandingController extends Controller
{
    //

    public function index(Tour $tour)
    {
        return view('admin.tour.landing.index', ['tour' => $tour]);
    }
}
