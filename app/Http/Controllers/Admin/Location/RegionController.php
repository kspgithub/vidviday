<?php

namespace App\Http\Controllers\Admin\Location;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Region;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request)
    {
        $query = Region::query();
        $country_id = $request->input('country_id', 0);
        $country = null;
        if ($country_id > 0) {
            $query->where('country_id', $country_id);
            $country = Country::findOrFail($country_id);
        }

        $regions = $query->orderBy('title->uk')->paginate(30);

        //
        return view('admin.region.index', [
            'country' => $country,
            'regions' => $regions,
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
        $region = new Region();
        $country = null;
        $country_id = $request->input('country_id', 0);
        if ($country_id > 0) {
            $country = Country::findOrFail($country_id);
            $region->country_id = $country->id;
        }

        return view('admin.region.create', [
            'country' => $country,
            'region' => $region,
            'countries' => $countries,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $region = new Region();
        $region->fill($request->all());
        $region->save();

        return redirect()->route('admin.region.index', ['country_id' => $region->country_id])->withFlashSuccess(__('Region created.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Region  $region
     * @return View
     */
    public function edit(Region $region)
    {
        $countries = Country::toSelectBox();
        $country = $region->country;
        //
        return view('admin.region.edit', [
            'country' => $country,
            'region' => $region,
            'countries' => $countries,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Region  $region
     * @return Response
     */
    public function update(Request $request, Region $region)
    {
        //
        $region->fill($request->all());
        $region->save();

        return redirect()->route('admin.region.index', ['country_id' => $region->country_id])->withFlashSuccess(__('Region updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Region  $region
     * @return Response
     */
    public function destroy(Region $region)
    {
        //
        $region->delete();

        return redirect()->route('admin.region.index', ['country_id' => $region->country_id])->withFlashSuccess(__('Region deleted.'));
    }
}
