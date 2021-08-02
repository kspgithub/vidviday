<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaffType;
use App\Models\Staff;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StaffTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        //
        $staffTypes = StaffType::query()->get();

        return view('admin.staff-type.index', compact('staffTypes'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $staffType = new StaffType();
        return view('admin.staff-type.create', [
            'staffType'=>$staffType,
        ]);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $staffType = new StaffType();
        $staffType->fill($request->all());
        $staffType->save();

        return redirect()->route('admin.staff-type.index')->withFlashSuccess(__('StaffType created.'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param StaffType $staffTypes
     *
     * @return View
     */
    public function edit(StaffType $staffType)
    {

        return view('admin.staff-type.edit', [
            'staffType' => $staffType,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Staff $staffTypes
     *
     * @return Response
     */
    public function update(Request $request, StaffType $staffTypes)
    {

        //
        $staffTypes->fill($request->all());
        $staffTypes->save();

        return redirect()->route('admin.staff-type.index')->withFlashSuccess(__('StaffType updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Staff $staffTypes
     *
     * @return Response
     */
    public function destroy(StaffType $staffTypes)
    {
        //

        $staffTypes->delete();

        return redirect()->route('admin.staff-type.index')->withFlashSuccess(__('StaffType deleted.'));
    }
}
