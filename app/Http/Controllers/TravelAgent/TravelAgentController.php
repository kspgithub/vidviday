<?php

namespace App\Http\Controllers\TravelAgent;

use App\Http\Controllers\Controller;
use App\Models\FaqItem;
use App\Models\Page;
use App\Models\PopupAd;
use App\Models\Tour;
use App\Services\TourService;
use Illuminate\Http\Request;

class TravelAgentController extends Controller
{
    //

    public function index()
    {
        $pageContent = view()->shared('pageContent', Page::published()
            ->where('key', 'for-travel-agents')->firstOrFail());

        $faqItems = FaqItem::where('section', FaqItem::SECTION_TOUR_AGENT)->orderBy('sort_order')->get();
        $tours = TourService::popularTours($pageContent);

        return view('travel-agent.index', [
            'pageContent' => $pageContent,
            'faqItems'=>$faqItems,
            'tours' => $tours,
        ]);
    }
}
