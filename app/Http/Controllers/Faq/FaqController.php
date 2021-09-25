<?php

namespace App\Http\Controllers\Faq;

use App\Http\Controllers\Controller;
use App\Models\FaqItem;
use App\Models\Page;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $pageContent = Page::query()->where('slug', 'faq')->first();
        $faqGroups = FaqItem::getBySections([FaqItem::SECTION_COMMON, FaqItem::SECTION_TOURIST, FaqItem::SECTION_TOUR_AGENT]);


        return view("faq.index", [
            'pageContent' => $pageContent,
            'faqGroups' => $faqGroups,
        ]);
    }
}
