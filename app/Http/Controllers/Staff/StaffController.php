<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffType;
use App\Models\Page;
use App\Models\Tour;


class StaffController extends Controller
{

    public function index()
    {
        //
        $staff = Staff::query()->published()->get();
        $pageContent = Page::select()->where('slug', 'office-workers')->first();

        return view('staff.index', [
            'staff' => $staff,
            'pageContent'=>$pageContent
        ]);
    }

    public function more($id)
    {
        $staff = Staff::all()->where('id', $id)->first();
        $tours = Tour::all();
        return view('staff.worker', ['staff' => $staff, 'tours' => $tours]);
    }
}
