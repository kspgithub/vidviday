<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Page;
use App\Models\PopupAd;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        //
        $documents = Document::all();
        $pageContent = Page::published()->where('key', 'our-documents')->firstOrFail();
        $popupAds = PopupAd::query()->forModel($pageContent)->get();

        return view('document.index',
            [
                'documents' => $documents,
                'pageContent' => $pageContent,
                'popupAds' => $popupAds,
            ]);
    }

}
