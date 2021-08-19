<?php

namespace App\Http\Controllers\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\TourGroup;
use App\Services\TourService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TourController extends Controller
{
    //


    public function index(Request $request, TourGroup $group = null)
    {
        $toursQuery = Tour::search();

        if ($group === null) {
            $tours = Tour::search()->filter($request->all())->paginate($request->input('per_page', 12));
            $request_title = TourService::searchRequestTitle($request->all());
            return view('tour.index', ['tours' => $tours, 'request_title' => $request_title]);
        }

        $toursQuery->whereHas('groups', function ($q) use ($group) {
            return $q->where('id', $group->id);
        });

        $min_price = (clone $toursQuery)->min('price');
        $max_price = (clone $toursQuery)->max('price');

        $tours = $toursQuery->paginate(12);

        return view('tour.group', [
            'tours' => $tours,
            'group' => $group,
            'min_price' => $min_price,
            'max_price' => $max_price,
        ]);
    }


    public function show(string $slug)
    {
        $tour = Tour::findBySlugOrFail($slug);

        $tour->loadMissing([
            'directions',
            'subjects',
            'types',
            'media',
            'places',
            'places.media',
        ]);

        $future_events = $tour->scheduleItems()
            ->whereDate('start_date', '>=', Carbon::now())->orderBy('start_date')->get();

        $nearest_event = $future_events->first();

        $similar_tours = $tour->getSimilarTours(12);

        return view('tour.show', [
            'tour' => $tour,
            'future_events' => $future_events,
            'nearest_event' => $nearest_event,
            'similar_tours' => $similar_tours,
        ]);
    }


    public function order(Request $request, Tour $tour)
    {
        return view('tour.order', ['tour' => $tour]);
    }
}
