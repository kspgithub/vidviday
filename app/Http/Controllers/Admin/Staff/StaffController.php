<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffType;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Image\Exceptions\InvalidManipulation;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.staff.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $users = User::onlyAdmins()->selectRaw("CONCAT_WS(' ', last_name, first_name) as text, id as value")
            ->get()->map(function ($it) {
                return ['value' => $it->value, 'text' => $it->text];
            });

        $staffTypes = StaffType::toSelectBox();
        $staff = new Staff();
        $tours = Tour::toSelectBox();

        return view('admin.staff.create', [
            'staff' => $staff,
            'users' => $users,
            'staffTypes' => $staffTypes,
            'tours' => $tours,
        ]);
    }

    /**
     * @param Request $request
     *
     * @return Response
     * @throws InvalidManipulation
     */
    public function store(Request $request)
    {
        //
        $staff = new Staff();
        $staff->fill($request->all());
        $staff->save();
        $staff->types()->sync($request->input('types', []));
        $staff->tours()->sync($request->input('tours', []));
        // Set tour manager_id
        // todo: ??? sync with $staff->manageTours ???
        $staff->manageTours()->each(function (Tour $tour) {
            $tour->manager_id = null;
            $tour->save();
        });
        $tours = Tour::query()->whereIn('id', $request->input('tours', []))->get();
        foreach ($tours as $tour) {
            $tour->manager_id = $staff->id;
            $tour->save();
        }
        if ($request->hasFile('avatar_upload')) {
            $staff->uploadAvatar($request->file('avatar_upload'));
        }
        return redirect()->route('admin.staff.edit', $staff)->withFlashSuccess(__('Record Created'));
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

        $users = User::onlyAdmins()->selectRaw("CONCAT_WS(' ', last_name, first_name) as text, id as value")
            ->get()->map(function ($it) {
                return ['value' => $it->value, 'text' => $it->text];
            });

        $staffTypes = StaffType::toSelectBox();
        $tours = Tour::toSelectBox();

        return view('admin.staff.edit', [
            'staff' => $staff,
            'users' => $users,
            'staffTypes' => $staffTypes,
            'tours' => $tours,
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
        $staff->tours()->sync($request->input('tours', []));
        // Set tour manager_id
        // todo: ??? sync with $staff->manageTours ???
        $staff->manageTours()->each(function (Tour $tour) {
            $tour->manager_id = null;
            $tour->save();
        });
        $tours = Tour::query()->whereIn('id', $request->input('tours', []))->get();
        foreach ($tours as $tour) {
            $tour->manager_id = $staff->id;
            $tour->save();
        }
        if ($request->hasFile('avatar_upload')) {
            $staff->uploadAvatar($request->file('avatar_upload'));
        }
        return redirect()->route('admin.staff.edit', $staff)->withFlashSuccess(__('Record Updated'));
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

        return redirect()->route('admin.staff.index')->withFlashSuccess(__('Record Deleted'));
    }
}
