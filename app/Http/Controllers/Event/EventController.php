<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\EventGroup;
use App\Models\EventItem;
use App\Models\PopupAd;
use App\Models\VisualOption;
use Illuminate\Http\Request;
use Storage;

class EventController extends Controller
{
    public function index(Request $request)
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

        $giftImage = VisualOption::where('key', 'gift_image')->first();

        return view('event.show', [
            'event' => $event,
            'tours' => $tours,
            'localeLinks' => $localeLinks,
            'giftImage' => $giftImage->value ? Storage::url($giftImage->value) : '/img/gift-certificate.jpg',
        ]);
    }
}
