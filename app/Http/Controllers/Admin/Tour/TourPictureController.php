<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;

class TourPictureController extends Controller
{
    //
    public function index(Tour $tour)
    {
        return view('admin.tour.pictures', ['tour' => $tour]);
    }
}
