<?php

namespace App\Http\Controllers\Admin\Tours;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PopularTour;
use App\Models\Tour;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class PopularToursController extends Controller
{
    private function getScopes()
    {
        $scopeKeys = ['corporates', 'schools', 'for-travel-agents'];

        return Arr::undot(Arr::dot(Page::query()->whereIn('key', $scopeKeys)
            ->pluck('title', 'id')
            ->toArray(), 'page_')
        );
    }
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $scopes = $this->getScopes();
        $parts = explode('_', $request->get('scope'));
        $type = ($parts[0] ?? null) ?: null;
        $id = $parts[1] ?? null;

        $query = PopularTour::query()
            ->type($type)
            ->model($id)
            ->with('tour')
            ->orderBy('position');

        $items = $query->get();

        return view('admin.popular-tours.index', [
            'scopes' => $scopes,
            'items' => $items,
        ]);
    }

    /**
     * @return View
     */
    public function create(Request $request)
    {
        $scopes = $this->getScopes();
        $parts = explode('_', $request->get('scope'));
        $type = ($parts[0] ?? null) ?: null;
        $id = $parts[1] ?? null;

        $popularTour = new PopularTour();

        $ids = PopularTour::query()
            ->type($type)
            ->model($id)
            ->pluck('tour_id')->toArray();

        $tours = Tour::toSelectBox()->filter(fn($tour) => !in_array($tour['value'], $ids));

        return view('admin.popular-tours.create', [
            'scopes' => $scopes,
            'model' => $popularTour,
            'tours' => $tours,
        ]);

    }

    public function store(Request $request)
    {
        $parts = explode('_', $request->get('scope'));
        $type = ($parts[0] ?? null) ?: null;
        $id = $parts[1] ?? null;

        $popularTour = new PopularTour();
        $popularTour->fill($request->all());

        if($type) {
            $popularTour->model_type = 'App\\Models\\' . ucwords($type);
        }
        if($id) {
            $popularTour->model_id = $id;
        }

        $popularTour->save();

        Cache::forget('popular-tours');

        if ($request->ajax()) {
            return response()->json(['result' => 'success', 'message' => __('Record Created'), 'model' => $popularTour]);
        }
        return redirect()->route('admin.popular-tours.index', $request->only(['scope']))->withFlashSuccess(__('Record Created'));
    }

    public function update(Request $request, PopularTour $popularTour)
    {
        $keys = ['popular-tours'];

        $popularTour->fill($request->all());

        if($popularTour->model_type) {
            $keys[] = Str::snake($popularTour->model_type);
        }
        if($popularTour->model_id) {
            $keys[] = Str::snake($popularTour->model_id);
        }

        $popularTour->save();

        Cache::forget(implode('_', $keys));

        if ($request->ajax()) {
            return response()->json(['result' => 'success', 'message' => __('Record Updated'), 'model' => $popularTour]);
        }
        return redirect()->route('admin.popular-tours.index', $request->only(['scope']))->withFlashSuccess(__('Record Updated'));
    }

    public function destroy(Request $request, PopularTour $popularTour)
    {
        //
        $popularTour->delete();
        $keys = ['popular-tours'];

        if($popularTour->model_type) {
            $keys[] = Str::snake($popularTour->model_type);
        }
        if($popularTour->model_id) {
            $keys[] = Str::snake($popularTour->model_id);
        }

        Cache::forget(implode('_', $keys));

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
