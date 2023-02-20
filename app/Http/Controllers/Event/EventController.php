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
        $eventGroups = EventGroup::whereHas('events', function ($q) {
            return $q->published();
        })->with(['events', 'events.media'])->get();

        return view('event.index', [
            'eventGroups' => $eventGroups,
        ]);
    }

    public function show(string $slug)
    {
        $event = EventItem::findBySlugOrFail($slug, false);

        if(!$event->published) {
            abort(404);
        }

        $popupAds = PopupAd::query()->forModel($event)->get();

        view()->share('popupAds', $popupAds);

        $event->checkSlugLocale($slug);

        $tours = $event->tours()->get();

        $localeLinks = $event->getLocaleLinks();

        return view('event.show', [
            'event' => $event,
            'tours' => $tours,
            'localeLinks' => $localeLinks,
        ]);
    }
}
