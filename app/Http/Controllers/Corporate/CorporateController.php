<?php

namespace App\Http\Controllers\Corporate;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\FaqItem;

class CorporateController extends Controller
{
    public function index()
    {
        //
    $pageContent = Page::select()->where('id', 12)->get();
    $faqItems = FaqItem::all();

        return view('corporate.index', [
            'pageContent'=>$pageContent,
            'faqItems'=>$faqItems
        ]);

    }
}
