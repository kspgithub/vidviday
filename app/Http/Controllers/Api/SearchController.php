<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\Tour;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function autocomplete(Request $request)
    {
        $q = $request->input('q', '');
        $limitTours = $request->input('tours', 4);
        $limitPlaces = $request->input('places', 1);


        $places = Place::autocomplete($q)->take($limitPlaces)->get()->map->shortInfo();
        if ($places->count() === 0) {
            $limitTours += $limitPlaces;
        }
        $tours = Tour::autocomplete($q)->take($limitTours)->get()->map->shortInfo();

        return response()->json([
            'tours' => $tours,
            'places' => $places,
        ]);

    }
}
