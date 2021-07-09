<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CityController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $citiesPrepeared = City::query()->orderBy('region_id');
        $citiesPaginated = $citiesPrepeared->paginate(20);
        $cities = $citiesPrepeared->get();//->sortBy('region_id');

        //
        return view('admin.city.index', ['cities'=>$cities, 'citiesPaginated'=>$citiesPaginated]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $countries = Country::toSelectBox();
        $regions = Region::toSelectBox();
        $city = new City();

        return view('admin.city.create', [
            'city'=>$city,
            'countries' => $countries,
            'regions' => $regions
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
        $city = new City();
        $city->fill($request->all());
        $city->save();

        return redirect()->route('admin.city.index')->withFlashSuccess(__('City created.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param City $city
     *
     * @return View
     */
    public function edit(City $city)
    {
        $countries = Country::toSelectBox();
        $regions = Region::toSelectBox();

        //
        return view('admin.city.edit', [
            'city' => $city,
            'countries' => $countries,
            'regions' => $regions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param City $city
     *
     * @return Response
     */
    public function update(Request $request, City $city)
    {

        //
        $city->fill($request->all());
        $city->save();

        return redirect()->route('admin.city.index')->withFlashSuccess(__('City updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param City $city
     *
     * @return Response
     */
    public function destroy(City $city)
    {
        //
        $city->delete();

        return redirect()->route('admin.city.index')->withFlashSuccess(__('City deleted.'));
    }

    public function mediaIndex(City $city)
    {
        return view('admin.city.media', ['city'=>$city]);
    }

}
