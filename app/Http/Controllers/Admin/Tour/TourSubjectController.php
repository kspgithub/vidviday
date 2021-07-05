<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\TourSubject;
use Illuminate\Http\Request;

class TourSubjectController extends Controller
{
    //

    public function index(Tour $tour)
    {
        $options = TourSubject::toSelectBox();
        $selected_ids = $tour->subjects()->pluck('id')->toArray();
        return view('admin.tour.subjects', [
            'tour'=>$tour,
            'options'=>$options,
            'selected_ids'=>$selected_ids,
        ]);
    }

    public function update(Request $request, Tour $tour)
    {
        $tour->subjects()->sync($request->input('subjects', []));

        return redirect()->back()->withFlashSuccess(__('Tour subjects updated.'));
    }
}
