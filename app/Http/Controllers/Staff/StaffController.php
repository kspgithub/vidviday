<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffType;
use App\Models\Page;


class StaffController extends Controller
{

    public function index()
    {
        //
        $staff = Staff::query()->published()->get();
        $pageContent = Page::select()->where('id', 4)->get();

        return view('staff.index', [
            'staff' => $staff,
            'pageContent'=>$pageContent
        ]);
    }

    public function more($id)
    {
        $staff = Staff::all()->where('id', $id)->first();
        return view('staff.worker', ['staff' => $staff]);
    }


}
