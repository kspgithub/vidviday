<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffType;
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
        $staffs = Staff::query()->with('types')->orderBy('last_name')->orderBy('first_name')->paginate(20);

        return view('admin.staff.index', [
            'staffs' => $staffs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $users = User::toSelectBox();
        $staffTypes = StaffType::toSelectBox();
        $staff = new Staff();

        return view('admin.staff.create', [
            'staff' => $staff,
            'users' => $users,
            'staffTypes' => $staffTypes
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
        $staff->types()->sync($request->input('types', []));
        if ($request->hasFile('avatar_upload')) {
            $staff->uploadAvatar($request->file('avatar_upload'));
        }
        return redirect()->route('admin.staff.edit', $staff)->withFlashSuccess(__('Staff created.'));
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

        $users = User::toSelectBox();
        $staffTypes = StaffType::toSelectBox();

        return view('admin.staff.edit', [
            'staff' => $staff,
            'users' => $users,
            'staffTypes' => $staffTypes
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Staff $staff
     *
     * @return Response
     */
    public function update(Request $request, Staff $staff)
    {
        //
        $staff->fill($request->all());
        $staff->save();
        $staff->types()->sync($request->input('types', []));
        if ($request->hasFile('avatar_upload')) {
            $staff->uploadAvatar($request->file('avatar_upload'));
        }
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

        return redirect()->route('admin.staff.index')->withFlashSuccess(__('Staff deleted.'));
    }
}
