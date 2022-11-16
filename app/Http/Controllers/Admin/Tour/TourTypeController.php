<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\TourType;
use Illuminate\Http\Request;

class TourTypeController extends Controller
{
    //
    public function index(Tour $tour)
    {
        $options = TourType::toSelectBox();
        $selected_ids = $tour->types()->pluck('id')->toArray();

        return view('admin.tour.types', [
            'tour'=>$tour,
            'options'=>$options,
            'selected_ids'=>$selected_ids,
        ]);
    }

    public function update(Request $request, Tour $tour)
    {
        $tour->types()->sync($request->input('types', []));

        return redirect()->back()->withFlashSuccess(__('Tour types updated.'));
    }
}
