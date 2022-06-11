<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Place;
use App\Models\Region;
use App\Models\Tour;
use App\Models\TourPlace;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TourPlacesController extends Controller
{
    public function index(Tour $tour)
    {
        return view('admin.tour.places.index', [
            'tour' => $tour,
        ]);
    }
}
