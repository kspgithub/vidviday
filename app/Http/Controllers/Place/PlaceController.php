<?php

namespace App\Http\Controllers\Place;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\Region;
use App\Models\City;
use App\Models\Tour;
use App\Models\Badge;
use App\Models\Page;

class PlaceController extends Controller
{

    public function index()
    {
        //

        $regions = Region::whereHas('places')->with(['places'])->get();
        $cities = City::whereHas('places')->with(['places'])->get();
        $pageContent = Page::select()->where('slug', 'places')->first();
        $badges = Badge::all();

        return view('place.index', [
            'regions' => $regions,
            'cities' => $cities,
            'pageContent' => $pageContent,
            'badges' => $badges
        ]);
    }

    public function more($slug)
    {
        $tours = Tour::search()->paginate(12);
        $places = Place::query()->where('slug', 'LIKE', '%"' . $slug . '"%')->firstOrFail();
        return view('place.place', [
            'places' => $places,
            'tours' => $tours
        ]);
    }
}
