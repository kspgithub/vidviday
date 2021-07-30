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
        return view('admin.tour-food.index', ['tour'=>$tour]);
    }


    public function create(Tour $tour)
    {
        $food = new TourFood();
        $food->tour_id = $tour->id;
        $foodTimes = FoodTime::toSelectBox();

        return view('admin.tour-food.create', ['tour'=>$tour, 'food'=>$food, 'foodTimes'=>$foodTimes]);
    }


    public function store(Request $request, Tour $tour)
    {
        $request->validate([
           'day'=>['required', 'numeric', 'min:1', 'max:'.$tour->duration],
           'time_id'=>['required', 'integer', Rule::exists('food_times', 'id')],
           'text'=>['required', 'string'],
           'published'=>['nullable','integer', Rule::in([0,1])],
           'position'=>['nullable','integer'],
        ]);

        $food = new TourFood();
        $food->tour_id = $tour->id;
        $food->fill($request->only(['day', 'time_id', 'text', 'published', 'position']));
        $food->save();
        return redirect()->route('admin.tour.food.edit', ['tour'=>$tour, 'food'=>$food])
            ->withFlashSuccess(__('Record Created'));
    }

    public function edit(Tour $tour, TourFood $food)
    {

        $foodTimes = FoodTime::toSelectBox();
        return view('admin.tour-food.edit', ['tour'=>$tour, 'food'=>$food, 'foodTimes'=>$foodTimes]);
    }
}
