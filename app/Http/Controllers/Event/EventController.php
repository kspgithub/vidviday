<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\EventGroup;
use App\Models\EventItem;


class EventController extends Controller
{
    public function index()
    {
        //
        $eventsItems = EventItem::with('group')->get();

        return view('event.index', [
            'eventsItems' => $eventsItems
        ]);
    }

}
