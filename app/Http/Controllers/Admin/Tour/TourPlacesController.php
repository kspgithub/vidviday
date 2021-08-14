<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourPlacesController extends Controller
{
    //

    public function index(Tour $tour)
    {
        $options = Place::orderBy('title')->toSelectBox();
        $selected_ids = $tour->places()->pluck('id')->toArray();

        return view('admin.tour.places', [
            'tour' => $tour,
            'options' => $options,
            'selected_ids' => $selected_ids,
        ]);
    }

    public function update(Request $request, Tour $tour)
    {
        $tour->places()->sync($request->input('places', []));

        return redirect()->back()->withFlashSuccess(__('Tour places updated.'));
    }
}
