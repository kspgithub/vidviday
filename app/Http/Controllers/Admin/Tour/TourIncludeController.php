<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourIncludeController extends Controller
{
    //

    public function index(Tour $tour)
    {
        return view('admin.tour.tour-includes', ['tour' => $tour]);
    }
}
