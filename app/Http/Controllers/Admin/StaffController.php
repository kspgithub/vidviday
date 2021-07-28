<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $staffsPrepeared = Staff::query()->orderBy('id');
        $staffsPaginated = $staffsPrepeared->paginate(20);
        $staffs = $staffsPrepeared->get();

        return view('admin.staff.index', [
            'staffs'=>$staffs,
            'staffsPaginated'=>$staffsPaginated
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $users = User::toSelectBoxS();
        $staff = new Staff();

        return view('admin.staff.create', [
            'staff'=>$staff,
            'users'=>$users
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
        $staff = new Staff();
        $staff->fill($request->all());
        $staff->save();

        return redirect()->route('admin.staff.index')->withFlashSuccess(__('Staff created.'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param Staff $staff
     *
     * @return View
     */
    public function edit(Staff $staff)
    {
        $users = User::toSelectBoxS();

        //
        return view('admin.staff.edit', [
            'staff' => $staff,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Region $staff
     *
     * @return Response
     */
    public function update(Request $request, Staff $staff)
    {

        //
        $staff->fill($request->all());
        $staff->save();

        return redirect()->route('admin.staff.index')->withFlashSuccess(__('Staff updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Staff $staff
     *
     * @return Response
     */
    public function destroy(Staff $staff)
    {
        //

        $staff->delete();

        return redirect()->route('admin.staff.index')->withFlashSuccess(__('Region deleted.'));
    }

}
