<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Helpers\Types\TourCorporateIncludes;
use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourCorporateIncludesController extends Controller
{

    public function index(Tour $tour)
    {
        $corporateIncludes = TourCorporateIncludes::values();

        return view('admin.tour.corporate_includes.index', [
            'tour' => $tour,
            'corporateIncludes' => $corporateIncludes,
        ]);
    }

    public function save(Request $request, Tour $tour)
    {
        $tour->update($request->all());

        return redirect()->route('admin.tour.corporate_includes.index', $tour)->withFlashSuccess(__('Record Updated'));
    }
}
