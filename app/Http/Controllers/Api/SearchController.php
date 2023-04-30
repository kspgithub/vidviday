<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\Tour;
use App\Models\WrongQuery;
use App\Services\TourService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

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

        /**
         * @var Collection $tours
         */
        $tours = Tour::filter($request->all())->inFuture()->take(1)->get()->map->shortInfo();

        if ($tours->count() < $limitTours) {
            $itemsLeft = $limitTours - $tours->count();

            $otherTours = Tour::filter($request->all())->unavailable()->take($itemsLeft)->get()->map->shortInfo();

            $tours = $tours->merge($otherTours);
        }

        if(!$tours->count() && !$places->count()) {
            TourService::handleWrongRequest($request);
        }

        return response()->json([
            'tours' => $tours,
            'places' => $places,
        ]);

    }
}
