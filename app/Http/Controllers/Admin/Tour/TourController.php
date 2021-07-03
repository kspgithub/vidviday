<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        //
        return view('admin.tour.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $tour = new Tour();

        return view('admin.tour.create', [
            'tour'=>$tour,
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
        $tour = new Tour();
        $tour->fill($request->all());
        $tour->save();

        return redirect()->route('admin.tour.edit', $tour)->withFlashSuccess(__('Tour created.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tour $tour
     *
     * @return View
     */
    public function edit(Tour $tour)
    {
        //
        return view('admin.tour.edit', [
            'tour'=>$tour,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Tour $tour
     *
     * @return Response
     */
    public function update(Request $request, Tour $tour)
    {
        //
        $tour->fill($request->all());
        $tour->save();

        return redirect()->route('admin.tour.edit', $tour)->withFlashSuccess(__('Tour updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tour $tour
     *
     * @return Response
     */
    public function destroy(Tour $tour)
    {
        //
        $tour->delete();

        return redirect()->route('admin.tour.index')->withFlashSuccess(__('Tour deleted.'));
    }
}
