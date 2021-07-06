<?php

namespace App\Http\Controllers\Admin\Place;

use App\Http\Controllers\Controller;
use App\Models\Direction;
use App\Models\Place;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        return view('admin.place.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $place = new Place();
        $directions = Direction::toSelectBox();

        return view('admin.place.create', compact('place', 'directions'));
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
        $place = new Place();
        $place->fill($request->all());

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

        return view('admin.place.edit', compact('place', 'directions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Place $place
     *
     * @return Response
     */
    public function update(Request $request, Place $place)
    {
        //
        $place->fill($request->all());

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
        //
        $place->delete();

        return redirect()->route('admin.place.index')->withFlashSuccess(__('Record Deleted'));
    }
}
