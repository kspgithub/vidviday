<?php

namespace App\Http\Controllers\Admin\Place;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Direction;
use App\Models\Place;
use App\Models\Region;
use App\Services\PlaceService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlaceController extends Controller
{
    protected $service;

    public function __construct(PlaceService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        //
        return view('admin.place.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        //
        $place = new Place();
        $place->country_id = Country::DEFAULT_COUNTRY_ID;
        $directions = Direction::toSelectBox();
        $countries = Country::toSelectBox();
        $regions = Region::query()->where('country_id', Country::DEFAULT_COUNTRY_ID)->toSelectBox();

        return view('admin.place.create', compact('place', 'directions', 'countries', 'regions'));
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
        $this->service->store($request->all());
        return redirect()->route('admin.place.index')->withFlashSuccess(__('Record Created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Place $place
     *
     * @return View
     */
    public function edit(Place $place)
    {
        //
        $directions = Direction::toSelectBox();
        $countries = Country::toSelectBox();
        $regions = Region::query()->where('country_id', Country::DEFAULT_COUNTRY_ID)->toSelectBox();

        return view('admin.place.edit', compact('place', 'directions', 'countries', 'regions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Place $place
     *
     * @return Response|JsonResponse
     */
    public function update(Request $request, Place $place)
    {
        //
        $this->service->update($place, $request->all());

        if ($request->ajax()) {
            return  response()->json(['result'=>'success', 'model'=>$place]);
        }
        return redirect()->route('admin.place.index')->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Place $place
     *
     * @return Response
     */
    public function destroy(Place $place)
    {
        $this->service->destroy($place);
        return redirect()->route('admin.place.index')->withFlashSuccess(__('Record Deleted'));
    }


    /**
     * @param Place $place
     * @return View
     */
    public function mediaIndex(Place $place)
    {
        return view('admin.place.media', ['place'=>$place]);
    }
}
