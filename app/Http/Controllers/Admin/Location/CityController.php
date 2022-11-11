<?php

namespace App\Http\Controllers\Admin\Location;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\Region;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request)
    {
        //

        $region = null;
        $district = null;
        $region_id = $request->input('region_id', 0);
        $district_id = $request->input('district_id', 0);
        if ($district_id > 0) {
            $district = District::findOrFail($district_id);
            $region = $district->region;
        } elseif ($region_id > 0) {
            $region = Region::findOrFail($region_id);
        }

        return view('admin.city.index', [
            'district' => $district,
            'region' => $region,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(Request $request)
    {
        $countries = Country::toSelectBox();
        $regions = Region::toSelectBox();
        $districts = District::toSelectBox();
        $city = new City();

        $region = null;
        $district = null;
        $region_id = $request->input('region_id', 0);
        $district_id = $request->input('district_id', 0);
        if ($district_id > 0) {
            $district = District::findOrFail($district_id);
            $city->district_id = $district->id;
            $city->region_id = $district->region_id;
            $city->country_id = $district->country_id;
            $region = $district->region;
        } elseif ($region_id > 0) {
            $region = Region::findOrFail($region_id);
            $city->region_id = $region->id;
            $city->country_id = $region->country_id;
        }

        return view('admin.city.create', [
            'city' => $city,
            'countries' => $countries,
            'regions' => $regions,
            'districts' => $districts,
            'district' => $district,
            'region' => $region,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request  $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $city = new City();
        $city->fill($request->all());
        $city->save();

        return redirect()->route('admin.city.edit', ['city' => $city])->withFlashSuccess(__('Record Created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param City  $city
     *
     * @return View
     */
    public function edit(City $city)
    {
        $countries = Country::toSelectBox();
        $regions = Region::toSelectBox();
        $districts = District::toSelectBox();

        //
        return view('admin.city.edit', [
            'city' => $city,
            'countries' => $countries,
            'regions' => $regions,
            'districts' => $districts,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request  $request
     * @param City  $city
     *
     * @return Response
     */
    public function update(Request $request, City $city)
    {
        //
        $city->fill($request->all());
        $city->save();

        return redirect()->route('admin.city.edit', ['city' => $city])->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param City  $city
     *
     * @return Response
     */
    public function destroy(City $city)
    {
        //
        $city->delete();

        return redirect()->route('admin.city.index')->withFlashSuccess(__('Record Deleted'));
    }

    /**
     * @param Request  $request
     *
     * @return mixed
     */
    public function search(Request $request)
    {
        $country_id = $request->input('country_id', Country::DEFAULT_COUNTRY_ID);
        $cityQuery = City::query()->where('cities.country_id', $country_id)->with(['region', 'country']);

        $region_id = (int) $request->input('region_id', 0);
        if ($region_id > 0) {
            $cityQuery->where('cities.region_id', $region_id);
        }

        $district_id = (int) $request->input('district_id', 0);
        if ($district_id > 0) {
            $cityQuery->where('cities.district_id', $district_id);
        }

        $q = $request->input('q', '');
        $limit = $request->input('limit', 20);

        if (! empty($q)) {
            $cityQuery->where('cities.title', 'LIKE', '%"'.$q.'%');
        }

        return $cityQuery->take($limit)->get()->map->asChoose();
    }
}
