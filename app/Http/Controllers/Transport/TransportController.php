<?php

namespace App\Http\Controllers\Transport;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Transport;

class TransportController extends Controller
{

    public function index()
    {
        //
        $pageContent = Page::where('key', 'transport')->first();

        $transports = Transport::published()->get();

        return view('transport.index', [
            'pageContent' => $pageContent,
            'transports' => $transports,
        ]);
    }


}
