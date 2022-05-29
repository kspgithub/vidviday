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

class TourPlacesController extends Controller
{
    //

    public function index(Tour $tour)
    {
        return view('admin.tour.places.index', [
            'tour' => $tour,
        ]);
    }

    public function create(Tour $tour)
    {
        $model = new TourPlace();
        $model->place_id = 0;
        $regions = Region::query()->toSelectBox();
        $districts = District::query()->toSelectBox();
        $places = Place::query()->get(['id', 'title', 'text']);

        return view('admin.tour.places.create', [
            'model' => $model,
            'tour' => $tour,
            'regions' => $regions,
            'districts' => $districts,
            'places' => $places,
        ]);
    }

    public function store(Request $request, Tour $tour)
    {
        $model = new TourPlace();
        $model->fill($request->all());
        $model->tour_id = $tour->id;
        if ((int)$model->place_id === 0) {
            $model->place_id = null;
        }
        $model->save();

        return redirect()->route('admin.tour.places.index', $tour)->withFlashSuccess(__('Record Created'));
    }

    public function edit(Tour $tour, TourPlace $model)
    {
        $regions = Region::query()->orderBy('title')->get();
        $districts = District::query()->orderBy('title')->get();
        $places = Place::query()->get();

        return view('admin.tour.places.edit', [
            'model' => $model,
            'tour' => $tour,
            'regions' => $regions,
            'districts' => $districts,
            'places' => $places,
        ]);
    }

    public function update(Request $request, Tour $tour, TourPlace $model)
    {
        $model->fill($request->all());
        $model->tour_id = $tour->id;
        if ((int)$model->place_id === 0) {
            $model->place_id = null;
        }
        $model->save();
        return redirect()->route('admin.tour.places.index', $tour)->withFlashSuccess(__('Record Updated'));
    }
}
