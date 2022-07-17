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
        $pageContent = Page::published()->where('key', 'schools')->firstOrFail();
        $faqItems = FaqItem::where('section', FaqItem::SECTION_CORPORATE)->orderBy('sort_order')->get();
        $tours = TourService::popularTours();

        $popupAds = PopupAd::query()->whereJsonContains('pages', $pageContent->key)->get();

        return view('schools.index', [
            'pageContent' => $pageContent,
            'faqItems' => $faqItems,
            'tours' => $tours,
            'popupAds' => $popupAds,
        ]);
    }
}
