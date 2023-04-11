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
        $tourSchedules = TourSchedule::inFuture()
            ->between($start, $end)
            ->filter($request->validated())
            ->whereHas('tour', function($query) use ($request) {
                $query->whereRaw("json_contains(locales, '\"$request->locales\"')");
            })
            ->with([
                'tour'
            ]);

        if ($request->tour_id) {
            $tourSchedules->where('tour_id', $request->tour_id);
        }

        $event_click = $request->input('event_click', 'url');
//      $schedules = TourSchedule::transformForBooking($query->get()); // todo: ???
        $schedules = $tourSchedules->get();
        return $schedules->values()->map->asCalendarEvent($event_click, $request->locales);
    }
}
