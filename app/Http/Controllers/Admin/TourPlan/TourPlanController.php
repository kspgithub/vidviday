<?php

namespace App\Http\Controllers\Admin\TourPlan;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tour\TourPlanBasicRequest;
use App\Models\Tour;
use App\Models\TourPlan;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class TourPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.tour-plan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $tourPlan = new TourPlan();

        $tours = Tour::toSelectBox('title', 'id');

        return view('admin.tour-plan.create', [
            'tourPlan' => $tourPlan,
            'tours' => $tours,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TourPlanBasicRequest $request)
    {
        $tourPlan = new TourPlan();

        $tourPlan->fill($request->all());
        $tourPlan->save();

        return redirect()->route('admin.tour-plan.index')->withFlashSuccess(__('Record Created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  TourPlan  $tourPlan
     * @return Application|Factory|View
     */
    public function edit(TourPlan $tourPlan)
    {
        $tours = Tour::toSelectBox('title', 'id');

        return view('admin.tour-plan.edit', [
            'tourPlan' => $tourPlan,
            'tours' => $tours,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TourPlanBasicRequest  $request
     * @param  TourPlan  $tourPlan
     * @return mixed
     *
     * @throws GeneralException
     */
    public function update(TourPlanBasicRequest $request, TourPlan $tourPlan)
    {
        $tourPlan->fill($request->all());
        $tourPlan->save();

        return redirect()->route('admin.tour-plan.index')->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  TourPlan  $tourPlan
     * @return mixed
     */
    public function destroy(TourPlan $tourPlan)
    {
        $tourPlan->delete();

        return redirect()->route('admin.tour-plan.index')->withFlashSuccess(__('Record deleted.'));
    }
}
