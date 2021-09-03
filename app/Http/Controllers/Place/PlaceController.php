<?php

namespace App\Http\Controllers\Place;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\Region;
use App\Models\City;
use App\Models\Tour;
use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //

        $places = Place::with('region', 'city')->get();
        $badges = Badge::all();

        return view('place.index', [
            'places' => $places,
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
