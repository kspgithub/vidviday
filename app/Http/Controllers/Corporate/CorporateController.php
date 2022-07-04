<?php

namespace App\Http\Controllers\Corporate;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\FaqItem;
use App\Models\Tour;
use App\Services\TourService;

class CorporateController extends Controller
{
    public function index()
    {
        //
        $pageContent = Page::where('key', 'corporates')->first();
        $faqItems = FaqItem::where('section', FaqItem::SECTION_CORPORATE)->orderBy('sort_order')->get();
        $tours = TourService::popularTours();

        return view('corporate.index', [
            'pageContent' => $pageContent,
            'faqItems' => $faqItems,
            'tours' => $tours
        ]);

    }
}
