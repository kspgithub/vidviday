<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlacesController extends Controller
{
    //

    /**
     * Поиск мест по названию (select box)
     *
     * @param Request  $request
     *
     * @return mixed
     */
    public function selectBox(Request $request)
    {
        $q = Str::lower($request->input('q', ''));
        $region_id = (int) $request->input('region_id', 0);
        $district_id = (int) $request->input('district_id', 0);
        $place_ids = explode(',', $request->input('place'));
        $query = Place::query();

        if ($district_id > 0) {
            $query->where('district_id', $district_id);
        }
        if ($region_id > 0) {
            $query->where('region_id', $region_id);
        }

        $items = collect();

        if ($place_ids) {
            $selected = (clone $query)->whereIn('id', $place_ids)->get();

            foreach ($selected as $item) {
                $items->push($item->asSelectBox('value'));
            }
        }

        if ($q) {
            $query->autocomplete($q);
        }

        $paginator = $query->paginate($request->input('limit', 10));

        foreach ($paginator->items() as $item) {
            $items->push($item->asSelectBox('value'));
        }

        $items = $items->unique('value')->toArray();

        return [
            'results' => $items,
            'pagination' => [
                'more' => $paginator->hasMorePages(),
            ],
        ];
    }

    public function show(Request $request)
    {
        $place_id = (int) $request->input('place_id', 0);

        $place = Place::query()->findOrFail($place_id);

        return response()->json([
            'description' => $place->text,
            'url' => $place->url,
            'media' => $place->getMedia()->map->toSwiperSlide(),
        ]);
    }

    public function get(Request $request)
    {
        $place_id = (int) $request->input('place_id', 0);

        $place = Place::query()->findOrFail($place_id);

        return response()->json($place);
    }
}
