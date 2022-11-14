<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;

class TourPlacesController extends Controller
{
    public function index(Tour $tour)
    {
        return view('admin.tour.places.index', [
            'tour' => $tour,
        ]);
    }
}
