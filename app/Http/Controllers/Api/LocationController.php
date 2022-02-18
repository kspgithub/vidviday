<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\Region;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function countries()
    {
        //
        return Country::toSelectBox();
    }

    public function regions(Request $request)
    {
        //
        $query = Region::query();
        $country_id = $request->input('country_id', 1);
        if ($country_id > 0) {
            $query->where('country_id', $country_id);
        }
        return $query->orderBy('title->uk')->toSelectBox();
    }

    public function districts(Request $request)
    {
        //
        $query = District::query();
        $country_id = $request->input('country_id', 1);

        if ($country_id > 0) {
            $query->where('country_id', $country_id);
        }
        $region_id = $request->input('region_id', 0);
        if ($region_id > 0) {
            $query->where('region_id', $region_id);
        }
       

        return $query->orderBy('title->uk')->toSelectBox();
    }

    public function cities(Request $request)
    {
        //
        $query = City::query();
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
        return $query->orderBy('title->uk')->toSelectBox();
    }
}
