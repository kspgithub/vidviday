<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\Country;
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
    public function index()
    {
        $regionsPrepeared = Region::query()->orderBy('id');
        $regionsPaginated = $regionsPrepeared->paginate(20);
        $regions = $regionsPrepeared->get();//->sortBy('region_id');

        //
        return view('admin.region.index', [
            'regions'=>$regions,
            'regionsPaginated'=>$regionsPaginated
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $countries = Country::toSelectBox();
        $region = new Region();

        return view('admin.region.create', [
            'region' => $region,
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
        $region = new Region();
        $region->fill($request->all());
        $region->save();

        return redirect()->route('admin.region.index')->withFlashSuccess(__('Region created.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Region $region
     *
     * @return View
     */
    public function edit(Region $region)
    {
        $countries = Country::toSelectBox();

        //
        return view('admin.region.edit', [
            'region' => $region,
            'countries' => $countries
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Region $region
     *
     * @return Response
     */
    public function update(Request $request, Region $region)
    {

        //
        $region->fill($request->all());
        $region->save();

        return redirect()->route('admin.region.index')->withFlashSuccess(__('Region updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Region $region
     *
     * @return Response
     */
    public function destroy(Region $region)
    {
        //
        $region->delete();

        return redirect()->route('admin.region.index')->withFlashSuccess(__('Region deleted.'));
    }

}
