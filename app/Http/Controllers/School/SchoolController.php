<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\FaqItem;
use App\Models\Page;
use App\Models\PopupAd;
use App\Models\Tour;
use App\Services\TourService;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index(Request $request)
    {
        //
        $pageContent = Page::published()->where('key', 'schools')->firstOrFail();
        $faqItems = FaqItem::where('section', FaqItem::SECTION_CORPORATE)->orderBy('sort_order')->get();
        $tours = TourService::popularTours($pageContent);

        return view('schools.index', [
            'faqItems' => $faqItems,
            'tours' => $tours,
        ]);
    }
}
