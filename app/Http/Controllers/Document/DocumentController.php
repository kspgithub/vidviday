<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Page;
use App\Models\PopupAd;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        //
        $documents = Document::all();
        $pageContent = Page::where('key', 'our-documents')->first();

        $popupAds = PopupAd::query()->whereJsonContains('pages', $pageContent->key)->get();

        return view('document.index',
            [
                'documents' => $documents,
                'pageContent' => $pageContent,
                'popupAds' => $popupAds,
            ]);
    }

}
