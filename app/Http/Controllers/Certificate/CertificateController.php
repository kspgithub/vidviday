<?php

namespace App\Http\Controllers\Certificate;

use App\Http\Controllers\Controller;
use App\Models\FaqItem;
use App\Models\Page;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    //

    public function index()
    {
        $pageContent = Page::where('key', 'certificate')->first();
        $faqItems = FaqItem::published()->where('section', FaqItem::SECTION_CERTIFICATE)->orderBy('sort_order')->get();
        return view('certificate.index', [
            'pageContent'=>$pageContent,
            'faqItems' => $faqItems,
        ]);
    }

    public function order()
    {

    }
}
