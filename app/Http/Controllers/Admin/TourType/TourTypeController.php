<?php

namespace App\Http\Controllers\Admin\TourType;

use App\Http\Controllers\Controller;
use App\Models\TourType;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TourTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        //
        $tourTypes = TourType::query()->withCount('media')->paginate(20);

        return view('admin.tour-type.index', compact('tourTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        //
        $tourType = new TourType();

        return view('admin.tour-type.create', compact('tourType'));
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
        $tourType = new TourType();
        $tourType->fill($request->all());
        $tourType->save();

        return redirect()->route('admin.tour-type.index')->withFlashSuccess(__('Record Created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TourType $tourType
     *
     * @return View
     */
    public function edit(TourType $tourType)
    {
        //
        return view('admin.tour-type.edit', compact('tourType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param TourType $tourType
     *
     * @return Response
     */
    public function update(Request $request, TourType $tourType)
    {
        //
        $tourType->fill($request->all());
        $tourType->save();

        return redirect()->route('admin.tour-type.index')->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TourType $tourType
     *
     * @return Response
     */
    public function destroy(TourType $tourType)
    {
        //
        $tourType->delete();

        return redirect()->route('admin.tour-type.index')->withFlashSuccess(__('Record Deleted'));
    }

    public function mediaIndex(TourType $tourType)
    {
        return view('admin.tour-type.media', compact('tourType'));
    }
}
