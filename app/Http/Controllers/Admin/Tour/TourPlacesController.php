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
        return view('admin.tour.places', [
            'tour' => $tour,
        ]);
    }

    public function update(Request $request, Tour $tour)
    {
        $tour->places()->sync($request->input('places', []));

        return redirect()->back()->withFlashSuccess(__('Tour places updated.'));
    }

    public function attach(Tour $tour, $id)
    {
        $tour->places()->attach($id, ['position' => $tour->places()->count() + 1]);
    }

    public function detach(Tour $tour, $id)
    {
        $tour->places()->detach($id);
    }
}
