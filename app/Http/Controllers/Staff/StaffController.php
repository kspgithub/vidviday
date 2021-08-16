<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffType;


class StaffController extends Controller
{

    public function index()
    {
        //
        $staff = Staff::all();

        return view('staff.index', [
            'staff' => $staff
        ]);
    }

    public function more($id)
    {
        $staff = Staff::all()->where('id', $id)->first();
        return view('staff.worker', ['staff' => $staff]);
    }


}
