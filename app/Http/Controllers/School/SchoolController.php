<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\FaqItem;
use App\Models\Page;
use App\Models\PopupAd;
use App\Models\Tour;
use App\Services\TourService;

class SchoolController extends Controller
{
    public function index()
    {
        //
        $faqItems = FaqItem::where('section', FaqItem::SECTION_CORPORATE)->orderBy('sort_order')->get();
        $tours = TourService::popularTours();

        return view('schools.index', [
            'faqItems' => $faqItems,
            'tours' => $tours,
        ]);
    }
}
