<?php

namespace App\Http\Controllers\Admin\TourGroup;

use App\Http\Controllers\Controller;
use App\Models\TourGroup;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TourGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        //
        $tourGroups = TourGroup::query()->withCount('media')->paginate(20);

        return view('admin.tour-group.index', compact('tourGroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        //
        $tourGroup = new TourGroup();

        return view('admin.tour-group.create', compact('tourGroup'));
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
        $tourGroup = new TourGroup();
        $tourGroup->fill($request->all());
        $tourGroup->save();
        return redirect()->route('admin.tour-group.index')->withFlashSuccess(__('Record Created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TourGroup $tourGroup
     *
     * @return View
     */
    public function edit(TourGroup $tourGroup)
    {
        //
        return view('admin.tour-group.edit', compact('tourGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param TourGroup $tourGroup
     *
     * @return Response
     */
    public function update(Request $request, TourGroup $tourGroup)
    {
        //
        $tourGroup->fill($request->all());
        $tourGroup->save();
        return redirect()->route('admin.tour-group.index')->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TourGroup $tourGroup
     *
     * @return Response
     */
    public function destroy(TourGroup $tourGroup)
    {
        //
        $tourGroup->delete();

        return redirect()->route('admin.tour-group.index')->withFlashSuccess(__('Record Deleted'));
    }


    public function mediaIndex(TourGroup $tourGroup)
    {
        return view('admin.tour-group.media', compact('tourGroup'));
    }
}
