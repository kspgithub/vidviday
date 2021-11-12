<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\Direction;
use App\Models\EventItem;
use App\Models\Page;


class EventController extends Controller
{
    public function index()
    {
        //
        $pageContent = Page::where('key', 'events')->first();

        $directions = Direction::whereHas('events', function ($q) {
            return $q->published();
        })->with(['events', 'events.groups', 'events.media'])->get();


        return view('event.index', [
            'directions' => $directions,
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
