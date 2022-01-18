<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tour\SearchEventsRequest;
use App\Models\TourSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CalendarController extends Controller
{
    //

    public function events(SearchEventsRequest $request)
    {
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);
        $query = TourSchedule::between($start, $end)->filter($request->validated())->with(['tour']);

        if ($request->tour_id) {
            $query->where('tour_id', $request->tour_id);
        }

        $event_click = $request->input('event_click', 'show');
        return $query->get()->map->asCalendarEvent($event_click);
    }
}