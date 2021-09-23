<?php

namespace App\Http\Controllers\TourGuide;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\Page;

class TourGuideController extends Controller
{

    public function index()
    {
        //
        $specialists = Staff::whereHas('types', function ($q) {
            return $q->where('slug', 'excursion-leader');
        })->get();
        $pageContent = Page::select()->where('slug', 'guides')->first();

        return view('tour-guide.index',
        [
        'specialists' => $specialists,
        'pageContent'=>$pageContent
        ]);
    }
    public function more($id)
    {
        $staff = Staff::all()->where('id', $id)->first();
        return view('staff.worker', ['staff' => $staff]);
    }
}
