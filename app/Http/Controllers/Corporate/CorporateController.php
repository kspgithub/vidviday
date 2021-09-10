<?php

namespace App\Http\Controllers\Corporate;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\FaqItem;
use App\Models\Tour;

class CorporateController extends Controller
{
    public function index()
    {
        //
    $pageContent = Page::select()->where('slug', 'corporates')->first();
    $faqItems = FaqItem::all();
    $tours = Tour::search()->paginate(12);

        return view('corporate.index', [
            'pageContent'=>$pageContent,
            'faqItems'=>$faqItems,
            'tours'=>$tours
        ]);

    }
}
