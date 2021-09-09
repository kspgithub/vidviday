<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourPlanController extends Controller
{
    //
    public function index(Tour $tour)
    {
        return view('admin.tour.plan', ['tour' => $tour]);
    }
}
