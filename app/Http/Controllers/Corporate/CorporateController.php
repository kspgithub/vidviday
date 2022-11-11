<?php

namespace App\Http\Controllers\Corporate;

use App\Http\Controllers\Controller;
use App\Models\FaqItem;
use App\Models\Page;
use App\Services\TourService;

class CorporateController extends Controller
{
    public function index()
    {
        //
        $pageContent = Page::published()->where('key', 'corporates')->firstOrFail();
        $faqItems = FaqItem::where('section', FaqItem::SECTION_CORPORATE)->orderBy('sort_order')->get();
        $tours = TourService::popularTours();

        return view('corporate.index', [
            'pageContent' => $pageContent,
            'faqItems' => $faqItems,
            'tours' => $tours,
        ]);
    }
}
