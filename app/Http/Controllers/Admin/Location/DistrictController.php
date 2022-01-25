<?php

namespace App\Http\Controllers\Admin\Location;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\District;
use App\Models\Region;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request)
    {
        $region = null;
        $region_id = $request->input('region_id', 0);
        if ($region_id > 0) {
            $region = Region::findOrFail($region_id);
        }

        //
        return view('admin.district.index', [
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
        $district = new District();
        $region_id = $request->input('region_id', 0);
        if ($region_id > 0) {
            $district->region_id = $region_id;
        }

        return view('admin.district.create', [
            'district' => $district,
            'regions' => $regions,
            'countries' => $countries,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $district = new District();
        $district->fill($request->all());
        $district->save();

        return redirect()->route('admin.district.edit', $district)->withFlashSuccess(__('Record Created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Region $region
     *
     * @return View
     */
    public function edit(District $district)
    {
        $countries = Country::toSelectBox();
        $regions = Region::toSelectBox();
        //
        return view('admin.district.edit', [
            'district' => $district,
            'regions' => $regions,
            'countries' => $countries
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param District $district
     *
     * @return Response
     */
    public function update(Request $request, District $district)
    {

        //
        $district->fill($request->all());
        $district->save();

        return redirect()->route('admin.district.edit', $district)->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Region $region
     *
     * @return Response
     */
    public function destroy(District $district)
    {
        //
        $district->delete();

        return redirect()->route('admin.district.index')->withFlashSuccess(__('Record Deleted'));
    }


    public function search(Request $request)
    {
        $country_id = $request->input('country_id', Country::DEFAULT_COUNTRY_ID);
        $query = District::query()->where('districts.country_id', $country_id)->with(['region', 'country']);
        $region_id = (int)$request->input('region_id', 0);

        if ($region_id > 0) {
            $query->where('districts.region_id', $region_id);
        }

        $q = $request->input('q', '');
        $limit = $request->input('limit', 20);


        if (!empty($q)) {
            $query->where('districts.title', 'LIKE', '%"' . $q . '%');
        }


        return $query->take($limit)->get()->map->asChoose();
    }
}
