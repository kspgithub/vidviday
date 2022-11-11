<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LandingPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LandingsController extends Controller
{
    //

    /**
     * Поиск мест по названию (select box)
     *
     * @param  Request  $request
     * @return mixed
     */
    public function selectBox(Request $request)
    {
        $q = Str::lower($request->input('q', ''));
        $query = LandingPlace::query();

        $paginator = $query->autocomplete($q)->paginate($request->input('limit', 10));
        $items = [];
        foreach ($paginator->items() as $item) {
            $items[] = $item->asSelectBox();
        }

        return [
            'results' => $items,
            'pagination' => [
                'more' => $paginator->hasMorePages(),
            ],
        ];
    }

    public function show(Request $request)
    {
        $landing_id = (int) $request->input('landing_id', 0);

        $landing = LandingPlace::query()->findOrFail($landing_id);

        return response()->json([
            'description' => $landing->text,
            'url' => $landing->url,
            'media' => $landing->getMedia()->map->toSwiperSlide(),
        ]);
    }

    public function get(Request $request)
    {
        $landing_id = (int) $request->input('landing_id', 0);

        $landing = LandingPlace::query()->findOrFail($landing_id);

        return response()->json($landing);
    }
}
