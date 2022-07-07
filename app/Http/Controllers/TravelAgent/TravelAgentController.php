<?php

namespace App\Http\Controllers\TravelAgent;

use App\Http\Controllers\Controller;
use App\Models\FaqItem;
use App\Models\Page;
use App\Models\PopupAd;
use App\Models\Tour;
use Illuminate\Http\Request;

class TravelAgentController extends Controller
{
    //

    public function index()
    {
        $pageContent = Page::where('key', 'for-travel-agents')->first();
        $faqItems = FaqItem::where('section', FaqItem::SECTION_TOUR_AGENT)->orderBy('sort_order')->get();
        $tours = Tour::search()->paginate(12);

        $popupAds = PopupAd::query()->whereJsonContains('pages', $pageContent->key)->get();

        return view('travel-agent.index', [
            'pageContent'=>$pageContent,
            'faqItems'=>$faqItems,
            'tours' => $tours,
            'popupAds' => $popupAds,
        ]);
    }
}
