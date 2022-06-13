<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AccommodationController extends Controller
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
//        $country_id = (int)$request->input('country_id', 0);
        $region_id = (int)$request->input('region_id', 0);
        $city_id = (int)$request->input('city_id', 0);
        $query = Accommodation::query();

//        if ($country_id > 0) {
//            $query->where('country_id', $country_id);
//        }
        if ($region_id > 0) {
            $query->where('region_id', $region_id);
        }
        if ($city_id > 0) {
            $query->where('city_id', $city_id);
        }
        $paginator = $query->autocomplete($q)->paginate($request->input('limit', 10));
        $items = [];
        foreach ($paginator->items() as $item) {
            $items[] = $item->asSelectBox();
        }

        return [
            'results' => $items,
            'pagination' => [
                'more' => $paginator->hasMorePages()
            ]
        ];
    }
}
