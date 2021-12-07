<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\TourPlan;
use Illuminate\Http\Request;

class TourPlanController extends Controller
{
    //
    public function index(Tour $tour)
    {
        $plan = $tour->planItems()->first();
        if ($plan === null) {
            $plan = new TourPlan();
            $plan->tour_id = $tour->id;
        }

        $locales = array_keys(config('site-settings.locale.languages'));
        $translations = $plan->getTranslations('text') ?? [];
        return view('admin.tour.plan', ['tour' => $tour, 'locales' => $locales, 'translations' => $translations]);
    }


    public function update(Request $request, Tour $tour)
    {
        $plan = $tour->planItems()->first();
        if ($plan === null) {
            $plan = new TourPlan();
            $plan->tour_id = $tour->id;
        }
        $plan->text = $request->input('text', []);
        $plan->save();
        return redirect()->route('admin.tour.plan.index', $tour)->withFlashSuccess(__('Updated'));
    }
}
