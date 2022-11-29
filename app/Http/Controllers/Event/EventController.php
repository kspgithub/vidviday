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

        $popupAds = PopupAd::query()
            ->join('popup_ad_rules', 'popup_ads.id', '=', 'popup_ad_rules.popup_ad_id')
            ->where('popup_ad_rules.model_type', EventItem::class)
            ->where(function ($q) use ($event){
                $q->where('popup_ad_rules.model_id', $event->id)->orWhere('popup_ad_rules.model_id', 0);
            })
            ->orderBy('popup_ad_rules.model_id', 'desc')
            ->limit(1)
            ->get();

        view()->share('popupAds', $popupAds);

        $event->checkSlugLocale($slug);

        $tours = $event->tours()->search()->get();

        $localeLinks = $event->getLocaleLinks();

        return view('event.show', [
            'event' => $event,
            'tours' => $tours,
            'localeLinks' => $localeLinks,
        ]);
    }
}
