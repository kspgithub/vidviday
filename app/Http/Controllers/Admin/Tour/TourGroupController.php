<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\TourGroup;
use Illuminate\Http\Request;

class TourGroupController extends Controller
{
    //

    public function index(Tour $tour)
    {
        $options = TourGroup::toSelectBox();
        $selected_ids = $tour->groups()->pluck('id')->toArray();

        return view('admin.tour.groups', [
            'tour' => $tour,
            'options' => $options,
            'selected_ids' => $selected_ids,
        ]);
    }

    public function update(Request $request, Tour $tour)
    {
        $tour->groups()->sync($request->input('groups', []));

        return redirect()->back()->withFlashSuccess(__('Tour groups updated.'));
    }
}
