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

    public function create(Tour $tour)
    {
        $model = new TourLanding();
        $model->landing_id = 0;
        $landings = LandingPlace::query()->get(['id', 'title', 'description']);
        return view('admin.tour.landing.create', [
            'model' => $model,
            'tour' => $tour,
            'landings' => $landings,
        ]);
    }

    public function store(Request $request, Tour $tour)
    {
        $model = new TourLanding();
        $model->fill($request->all());
        $model->tour_id = $tour->id;
        if ((int)$model->landing_id === 0) {
            $model->landing_id = null;
        }
        $model->save();

        return redirect()->route('admin.tour.landing.index', $tour)->withFlashSuccess(__('Record Created'));
    }

    public function edit(Tour $tour, TourLanding $model)
    {
        $landings = LandingPlace::query()->get();
        return view('admin.tour.landing.edit', [
            'model' => $model,
            'tour' => $tour,
            'landings' => $landings,
        ]);
    }

    public function update(Request $request, Tour $tour, TourLanding $model)
    {
        $model->fill($request->all());
        $model->tour_id = $tour->id;
        if ((int)$model->landing_id === 0) {
            $model->landing_id = null;
        }
        $model->save();
        return redirect()->route('admin.tour.landing.index', $tour)->withFlashSuccess(__('Record Updated'));
    }
}
