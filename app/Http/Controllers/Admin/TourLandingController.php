<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingPlace;
use App\Models\Tour;
use Illuminate\Http\Request;


class TourLandingController extends Controller
{
    public function index(Request $request, Tour $tour)
    {
        //
        if ($request->ajax()) {
            return response()->json($tour->landings()->get()->map(function ($item, $idx) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'position' => $idx,
                ];
            }));
        }

        return view('admin.tour-landing.index', [
            'tour' => $tour,
        ]);
    }


    /**
     * Поиск мест по названию (select box)
     * @param Request $request
     * @return mixed
     */
    public function selectBox(Request $request)
    {
        $q = $request->input('q', '');

        $query = LandingPlace::query();

        if (!empty($q)) {
            $query->jsonLike('title', $q);
        }

        $paginator = $query->paginate($request->input('limit', 10));
        $items = [];
        foreach ($paginator->items() as $item) {
            $items[] = $item->asSelectBox('title', 'id', 'text', 'id');
        }

        return [
            'results' => $items,
            'pagination' => [
                'more' => $paginator->hasMorePages()
            ]
        ];
    }

    public function attach(Tour $tour, $id)
    {
        if ($id > 0 && $tour->landings()->where('id', $id)->count() === 0) {
            $tour->landings()->attach([$id => [
                'position' => $tour->landings()->count(),
            ]]);
        }
        return response()->json(['result' => 'success']);
    }

    public function detach(Tour $tour, $id)
    {
        if ($id > 0 && $tour->landings()->where('id', $id)->count() > 0) {
            $tour->landings()->detach($id);
        }
        return response()->json(['result' => 'success']);
    }

    public function updatePosition(Request $request, Tour $tour)
    {
        $ids = $request->input('ids', []);
        $items = [];
        foreach ($ids as $pos => $id) {
            $items[$id] = [
                'position' => $pos,
            ];
        }

        $tour->landings()->sync($items);

        return response()->json($tour->landings()->get()->map(function ($item, $idx) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'position' => $idx,
            ];
        }));
    }
}
