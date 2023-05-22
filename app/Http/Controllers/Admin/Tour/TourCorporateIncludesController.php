<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourCorporateIncludesController extends Controller
{

    public function index(Tour $tour)
    {
        $corporateIncludes = [
            [
                'text' => __('Екскурсійний супровід'),
                'value' => 'support',
            ],
            [
                'text' => __('Проїзд у туристичному автобусі'),
                'value' => 'bus',
            ],
            [
                'text' => __('Поселення'),
                'value' => 'apartment',
            ],
            [
                'text' => __('Харчування'),
                'value' => 'food',
            ],
            [
                'text' => __('Вхідні квитки'),
                'value' => 'ticket',
            ],
            [
                'text' => __('Страхування на час подорожі'),
                'value' => 'insurance',
            ],
        ];

        return view('admin.tour.corporate_includes.index', [
            'tour' => $tour,
            'corporateIncludes' => $corporateIncludes,
        ]);
    }

    public function save(Request $request, Tour $tour)
    {
        $data = $request->get('corporate_includes', []);

        $tour->update(['corporate_includes' => $data]);

        return redirect()->route('admin.tour.corporate_includes.index', $tour)->withFlashSuccess(__('Record Updated'));
    }
}
