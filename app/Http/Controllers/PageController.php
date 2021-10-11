<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Place\PlaceController;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Tour\TourController;
use App\Http\Controllers\TourGuide\TourGuideController;
use App\Models\Page;
use App\Models\Place;
use App\Models\Tour;
use App\Models\TourGroup;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function show(Request $request, $slug)
    {
        if (Tour::existBySlug($slug)) {
            return (new TourController())->show($slug);
        }

        if (Place::existBySlug($slug)) {
            return (new PlaceController())->show($slug);
        }


        $tourGroup = TourGroup::findBySlug($slug);
        if ($tourGroup !== null) {
            return (new TourController())->index($request, $tourGroup);
        }

        $pageContent = Page::findBySlugOrFail($slug);

        switch ($pageContent->key) {
            case 'guides':
                return (new TourGuideController())->index();
            case 'office-workers':
                return (new StaffController())->index();
            default:
                return view('page.show', ['pageContent' => $pageContent]);
        }


    }
}
