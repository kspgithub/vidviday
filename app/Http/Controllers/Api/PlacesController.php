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
     * @param Request $request
     * @return mixed
     */
    public function selectBox(Request $request)
    {
        $q = Str::lower($request->input('q', ''));
        $region_id = (int)$request->input('region_id', 0);
        $district_id = (int)$request->input('district_id', 0);
        $query = Place::query();

        if ($district_id > 0) {
            $query->where('district_id', $district_id);
        }
        if($region_id > 0) {
            $query->where('region_id', $region_id);
        }

        $paginator = $query->autocomplete($q)->paginate($request->input('limit', 10));
        $items = [];

        foreach ($paginator->items() as $item) {
            $items[] = $item->asSelectBox('value');
        }

        return [
            'results' => $items,
            'pagination' => [
                'more' => $paginator->hasMorePages()
            ]
        ];
    }

    public function show(Request $request)
    {
        $place_id = (int)$request->input('place_id', 0);

        $place = Place::query()->findOrFail($place_id);

        return response()->json([
            'description' => $place->text,
            'url' => $place->url,
            'media' => $place->getMedia()->map->toSwiperSlide(),
        ]);
    }

    public function get(Request $request)
    {
        $place_id = (int)$request->input('place_id', 0);

        $place = Place::query()->findOrFail($place_id);

        return response()->json($place);
    }
}
