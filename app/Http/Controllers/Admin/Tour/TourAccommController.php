<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Models\AccommodationType;
use App\Models\Tour;
use App\Models\TourAccommodation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TourAccommController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|View
     */
    public function index(Tour $tour)
    {
        //
        $items = $tour->accommodations()->with(['accommodation', 'types'])->get();
        return view('admin.tour-accommodation.index', [
            'tour' => $tour,
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|View
     */
    public function create(Tour $tour)
    {
        //
        $accomm = new TourAccommodation();
        $accommodations = Accommodation::toSelectBox();
        $types = AccommodationType::toSelectBox();

        return view('admin.tour-accommodation.create', [
            'tour' => $tour,
            'accomm' => $accomm,
            'accommodations' => $accommodations,
            'types' => $types,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request, Tour $tour)
    {
        //
        $accomm = new TourAccommodation();
        $accomm->tour_id = $tour->id;
        $accomm->fill($request->all());
        $accomm->save();
        $accomm->types()->sync($request->input('types', []));
        return redirect()->route('admin.tour.accomm.index', $tour)->withFlashSuccess(__('Record Created'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param TourAccommodation $accomm
     * @return Response|View
     */
    public function edit(Tour $tour, TourAccommodation $accomm)
    {
        //
        $accommodations = Accommodation::toSelectBox();
        $types = AccommodationType::toSelectBox();

        return view('admin.tour-accommodation.edit', [
            'tour' => $tour,
            'accomm' => $accomm,
            'accommodations' => $accommodations,
            'types' => $types,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param TourAccommodation $accomm
     * @return Response
     */
    public function update(Request $request, Tour $tour, TourAccommodation $accomm)
    {
        //
        $accomm->fill($request->all());
        $accomm->save();
        $accomm->types()->sync($request->input('types', []));
        return redirect()->route('admin.tour.accomm.index', $tour)->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TourAccommodation $accomm
     * @return Response
     */
    public function destroy(Tour $tour, TourAccommodation $accomm)
    {
        //
        $accomm->delete();
        return redirect()->route('admin.tour.accomm.index', $tour)->withFlashSuccess(__('Record Deleted'));
    }
}
