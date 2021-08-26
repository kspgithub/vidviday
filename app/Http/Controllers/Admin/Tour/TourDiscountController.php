<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Tour;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TourDiscountController extends Controller
{
    /**
     * Display a listing of the resource discounts.
     *
     * @param Tour $tour
     *
     * @return Application|Factory|View
     */
    public function index(Tour $tour)
    {
        $options = Discount::toSelectBox();
        $selected_ids = $tour->discounts()->pluck('id')->toArray();

        return view('admin.tour.discounts', [
            'tour'=>$tour,
            'options'=>$options,
            'selected_ids'=>$selected_ids,
        ]);
    }

    /**
     * Allows you to attach discounts to a tour.
     *
     * @param Request $request
     *
     * @param Tour $tour
     *
     * @return mixed
     */
    public function update(Request $request, Tour $tour)
    {
        $tour->discounts()->sync($request->input('discounts', []));

        return redirect()->back()->withFlashSuccess(__('Tour discount updated.'));
    }
}
