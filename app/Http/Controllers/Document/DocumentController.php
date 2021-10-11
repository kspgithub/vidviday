<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Page;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        //
        $documents = Document::all();
        $pageContent = Page::select()->where('key', 'our-documents')->first();
        return view('document.index',
            [
                'documents' => $documents,
                'pageContent' => $pageContent
            ]);
    }

}
