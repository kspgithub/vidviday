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
        $specialists = Staff::published()->whereHas('types', function ($q) {
            return $q->where('slug', 'excursion-leader');
        })->withCount(['testimonials', 'tours'])->get();

        $pageContent = Page::select()->where('key', 'guides')->first();

        return view('tour-guide.index',
            [
                'specialists' => $specialists,
                'pageContent' => $pageContent
            ]);
    }

    public function show(Staff $staff)
    {
        $staff->loadMissing('testimonials');
        $tours = $staff->tours()->with('scheduleItems', function ($q) {
            return $q->inFuture();
        })->get();
        return view('staff.guide', ['staff' => $staff, 'tours' => $tours]);
    }
}
