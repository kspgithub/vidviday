<?php

namespace App\Http\Controllers\TravelAgent;

use App\Http\Controllers\Controller;
use App\Models\FaqItem;
use App\Models\Tour;

class TravelAgentController extends Controller
{
    //

    public function index()
    {
        $faqItems = FaqItem::where('section', FaqItem::SECTION_TOUR_AGENT)->orderBy('sort_order')->get();
        $tours = Tour::search()->paginate(12);

        return view('travel-agent.index', [
            'faqItems' => $faqItems,
            'tours' => $tours,
        ]);
    }
}
