<?php

namespace App\Http\Controllers\Admin\Tours;

use App\Http\Controllers\Controller;
use App\Models\PopularTour;
use App\Models\Tour;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PopularToursController extends Controller
{
    /**
     * @param  Request  $request
     * @return View
     */
    public function index(Request $request)
    {
        $items = PopularTour::query()->orderBy('position')
            ->with('tour')->get();

        return view('admin.popular-tours.index', ['items' => $items]);
    }

    /**
     * @return View
     */
    public function create()
    {
        //
        $popularTour = new PopularTour();

        $ids = PopularTour::query()->pluck('tour_id')->toArray();

        $tours = Tour::toSelectBox()->filter(fn ($tour) => ! in_array($tour['value'], $ids));

        return view('admin.popular-tours.create', [
            'model' => $popularTour,
            'tours' => $tours,
        ]);
    }

    public function store(Request $request)
    {
        //
        $popularTour = new PopularTour();
        $popularTour->fill($request->all());
        $popularTour->save();

        Cache::forget('popular-tours');

        if ($request->ajax()) {
            return response()->json(['result' => 'success', 'message' => __('Record Created'), 'model' => $popularTour]);
        }

        return redirect()->route('admin.popular-tours.index')->withFlashSuccess(__('Record Created'));
    }

    public function update(Request $request, PopularTour $popularTour)
    {
        //
        $popularTour->fill($request->all());
        $popularTour->save();

        Cache::forget('popular-tours');

        if ($request->ajax()) {
            return response()->json(['result' => 'success', 'message' => __('Record Updated'), 'model' => $popularTour]);
        }

        return redirect()->route('admin.popular-tours.index')->withFlashSuccess(__('Record Updated'));
    }

    public function destroy(Request $request, PopularTour $popularTour)
    {
        //
        $popularTour->delete();

        Cache::forget('popular-tours');

        if ($request->ajax()) {
            return response()->json(['result' => 'success', 'message' => __('Record Deleted'), 'model' => $popularTour]);
        }

        return redirect()->route('admin.popular-tours.index')->withFlashSuccess(__('Record Deleted'));
    }

    public function sort(Request $request)
    {
        $ids = $request->input('order', []);
        foreach ($ids as $position => $id) {
            PopularTour::whereId($id)->update(['position' => $position]);
        }

        Cache::forget('popular-tours');

        if ($request->ajax()) {
            return response()->json(['result' => 'success', 'message' => __('Record Updated')]);
        }
    }
}
