<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\Direction;
use App\Models\EventGroup;
use App\Models\EventItem;
use App\Models\Page;


class EventController extends Controller
{
    public function index()
    {
        //
        $pageContent = Page::where('key', 'events')->first();

        $eventGroups = EventGroup::whereHas('events', function ($q) {
            return $q->published();
        })->with(['events', 'events.media'])->get();

        return view('event.index', [
            'eventGroups' => $eventGroups,
            'pageContent' => $pageContent,
        ]);
    }


    public function show(string $slug)
    {
        $event = EventItem::findBySlugOrFail($slug);

        return view('event.show', [
            'event' => $event,
        ]);
    }
}
