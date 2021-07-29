<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tour\TourBasicRequest;
use App\Models\Currency;
use App\Models\Tour;
use App\Services\TourService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TourController extends Controller
{
    protected $service;

    public function __construct(TourService $service)
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
        $tour->currency = 'UAH';
        $currencies = Currency::toSelectBox('iso', 'iso');

        return view('admin.tour.create', [
            'tour'=>$tour,
            'currencies'=>$currencies,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TourBasicRequest $request
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return Response
     */
    public function store(TourBasicRequest $request)
    {
        //
        $tour = $this->service->store($request->validated());

        return redirect()->route('admin.tour.picture.index', ['tour'=>$tour])->withFlashSuccess(__('Tour created.'));
    }

    public function show(Tour $tour){
        return redirect()->route('admin.tour.edit', $tour);
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
        $currencies = Currency::toSelectBox('iso', 'iso');

        return view('admin.tour.edit', [
            'tour'=>$tour,
            'currencies'=>$currencies,
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
    public function update(TourBasicRequest $request, Tour $tour)
    {
        //
        $this->service->update($tour, $request->validated());

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
