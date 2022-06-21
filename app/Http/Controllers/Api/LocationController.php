<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LocationController extends Controller
{
    public function countries(Request $request)
    {
        //
        $query = Country::query()->orderBy('title->uk');

        if($request->paginate) {
            $paginator = $query->paginate($request->input('limit', 10));
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

        return $query->toSelectBox();
    }

    public function regions(Request $request)
    {
        //
        $query = Region::query()->orderBy('title->uk');
        $country_id = $request->input('country_id', 1);
        if ($country_id > 0) {
            $query->where('country_id', $country_id);
        }

        if($search = Str::lower($request->get('q'))){
            $query->jsonLike('title', "%$search%");
        }

        if($limit = $request->get('limit')){
            $query->limit($limit);
        }

        if($request->paginate) {
            $paginator = $query->paginate($request->input('limit', 10));
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

        return $query->toSelectBox();
    }

    public function districts(Request $request)
    {
        //
        $query = District::query()->orderBy('title->uk');
        $country_id = $request->input('country_id', 1);

        if ($country_id > 0) {
            $query->where('country_id', $country_id);
        }
        $region_id = $request->input('region_id', 0);
        if ($region_id > 0) {
            $query->where('region_id', $region_id);
        }

        if($search = Str::lower($request->get('q'))){
            $query->jsonLike('title', "%$search%");
        }

        if($limit = $request->get('limit')){
            $query->limit($limit);
        }

        if($request->paginate) {
            $paginator = $query->paginate($request->input('limit', 10));
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

        return $query->toSelectBox();
    }

    public function cities(Request $request)
    {
        //
        $query = City::query()->orderBy('title->uk');
        $country_id = $request->input('country_id', 1);

        if ($country_id > 0) {
            $query->where('country_id', $country_id);
        }
        $region_id = $request->input('region_id', 0);
        if ($region_id > 0) {
            $query->where('region_id', $region_id);
        }
        $district_id = $request->input('district_id', 0);
        if ($district_id > 0) {
            $query->where('district_id', $district_id);
        }

        if($search = Str::lower($request->get('q'))){
            $query->jsonLike('title', "%$search%");
        }

        if($limit = $request->get('limit')){
            $query->limit($limit);
        }

        if($request->paginate) {
            $paginator = $query->paginate($request->input('limit', 10));
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

        return $query->get()->map(fn($item) => [
            'value' => $item['id'],
            'text' => $item['fullTitle'],
        ]);
    }
}
