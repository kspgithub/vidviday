<?php

namespace App\Http\Controllers\Admin\Accommodation;

use App\Http\Controllers\Controller;
use App\Models\AccommodationType;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccommodationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        //
        $types = AccommodationType::all();

        return view('admin.accommodation-type.index', ['types' => $types]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        //
        $type = new AccommodationType();

        return view('admin.accommodation-type.create', ['type' => $type]);
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
        $request->validate([
            'title' => ['required', 'max:100'],
            'description' => ['required', 'max:500'],
        ]);

        $type = new AccommodationType();
        $type->fill($request->only(['title', 'description', 'slug']));
        $type->save();

        return redirect()->route('admin.accommodation-type.index')->withFlashSuccess(__('Record Crated'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  AccommodationType  $accommodationType
     * @return View
     */
    public function edit(AccommodationType $accommodationType)
    {
        //
        return view('admin.accommodation-type.edit', ['type' => $accommodationType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  AccommodationType  $accommodationType
     * @return Response
     */
    public function update(Request $request, AccommodationType $accommodationType)
    {
        $request->validate([
            'title' => ['required', 'max:100'],
            'description' => ['required', 'max:500'],
        ]);

        $accommodationType->fill($request->only(['title', 'description', 'slug']));
        $accommodationType->save();

        return redirect()->route('admin.accommodation-type.index')->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  AccommodationType  $accommodationType
     * @return Response
     */
    public function destroy(AccommodationType $accommodationType)
    {
        //
        $accommodationType->delete();

        return redirect()->route('admin.accommodation-type.index')->withFlashSuccess(__('Record Deleted'));
    }
}
