<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TourSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CalendarController extends Controller
{
    //

    public function events(Request $request)
    {
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);
        $query = TourSchedule::query()
            ->with(['tour'])
            ->where(function ($sq) use ($start, $end) {
                $sq->where(function ($q) use ($start, $end) {
                    return $q ->whereDate('start_date', '>=', $start->toDateString())
                        ->whereDate('start_date', '<=', $end->toDateString());
                })
                    ->orWhere(function ($q) use ($start, $end) {
                        return $q ->whereDate('end_date', '>=', $start->toDateString())
                            ->whereDate('end_date', '<=', $end->toDateString());
                    })
                    ->orWhere(function ($q) use ($start, $end) {
                        return $q ->whereDate('start_date', '<', $start->toDateString())
                            ->whereDate('end_date', '>', $end->toDateString());
                    });
            });

        if ($request->tour_id) {
            $query->where('tour_id', $request->tour_id);
        }

        $event_click = $request->input('event_click', 'show');
        return $query->get()->map->asCalendarEvent($event_click);
    }
}
