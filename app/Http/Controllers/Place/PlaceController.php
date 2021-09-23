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
        $places = Place::first();
        $pageContent = Page::select()->where('slug', 'places')->first();

        return view('place.index', [
            'regions' => $regions,
            'places' => $places,
            'pageContent' => $pageContent
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
