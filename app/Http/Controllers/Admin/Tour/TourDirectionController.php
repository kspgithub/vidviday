<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Direction;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourDirectionController extends Controller
{
    //
    public function index(Tour $tour)
    {
        $options = Direction::toSelectBox();
        $selected_ids = $tour->directions()->pluck('id')->toArray();

        return view('admin.tour.directions', [
            'tour'=>$tour,
            'options'=>$options,
            'selected_ids'=>$selected_ids,
        ]);
    }

    public function update(Request $request, Tour $tour)
    {
        $tour->directions()->sync($request->input('directions', []));

        return redirect()->back()->withFlashSuccess(__('Tour directions updated.'));
    }
}
