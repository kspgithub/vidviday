<?php

namespace App\Http\Controllers\Admin\TourInclude;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tour\TourIncludeBasicRequest;
use App\Models\IncludeType;
use App\Models\Tour;
use App\Models\TourInclude;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class TourIncludeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.tour-include.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $tourInclude = new TourInclude();

        $tours = Tour::toSelectBox('title', 'id');

        $includeTypes = IncludeType::toSelectBox('title', 'id');

        return view('admin.tour-include.create', [
            'tourInclude' => $tourInclude,
            'includeTypes' => $includeTypes,
            'tours' => $tours,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TourIncludeBasicRequest  $request
     *
     * @return mixed
     */
    public function store(TourIncludeBasicRequest $request)
    {
        $tourInclude = new TourInclude();

        $tourInclude->fill($request->all());
        $tourInclude->save();

        return redirect()->route('admin.tour-include.index', ['tourInclude' => $tourInclude])
                         ->withFlashSuccess(__('Record created.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TourInclude  $tourInclude
     *
     * @return Application|Factory|View
     */
    public function edit(TourInclude $tourInclude)
    {
        $tours = Tour::toSelectBox('title', 'id');

        $includeTypes = IncludeType::toSelectBox('title', 'id');

        return view('admin.tour-include.edit', [
            'tourInclude' => $tourInclude,
            'includeTypes' => $includeTypes,
            'tours' => $tours,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TourIncludeBasicRequest  $request
     * @param TourInclude  $tourInclude
     *
     * @throws GeneralException
     *
     * @return mixed
     */
    public function update(TourIncludeBasicRequest $request, TourInclude $tourInclude)
    {
        $tourInclude->fill($request->all());
        $tourInclude->save();

        return redirect()->route('admin.tour-include.index', $tourInclude)
                         ->withFlashSuccess(__('record updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TourInclude  $tourInclude
     *
     * @return mixed
     */
    public function destroy(TourInclude $tourInclude)
    {
        $tourInclude->delete();

        return redirect()->route('admin.tour-include.index')->withFlashSuccess(__('Record deleted.'));
    }
}
