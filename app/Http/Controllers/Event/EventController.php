<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\Direction;
use App\Models\EventGroup;
use App\Models\EventItem;
use App\Models\Page;
use App\Models\PopupAd;


class EventController extends Controller
{
    public function index()
    {
        //
        $pageContent = Page::published()->where('key', 'events')->firstOrFail();

        $eventGroups = EventGroup::whereHas('events', function ($q) {
            return $q->published();
        })->with(['events', 'events.media'])->get();

        $popupAds = PopupAd::query()->whereJsonContains('pages', $pageContent->key)->get();

        return view('event.index', [
            'eventGroups' => $eventGroups,
            'pageContent' => $pageContent,
            'popupAds' => $popupAds,
        ]);
    }


    public function show(string $slug)
    {
        $event = EventItem::findBySlugOrFail($slug);

        $tours = $event->tours()->search()->get();

        return view('event.show', [
            'event' => $event,
            'tours' => $tours,
        ]);
    }
}
