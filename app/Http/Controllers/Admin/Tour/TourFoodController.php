<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\FoodTime;
use App\Models\Tour;
use App\Models\TourFood;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TourFoodController extends Controller
{
    //

    public function index(Tour $tour)
    {
        return view('admin.tour.food', ['tour' => $tour]);
    }
}
