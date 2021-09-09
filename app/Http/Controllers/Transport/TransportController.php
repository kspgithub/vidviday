<?php

namespace App\Http\Controllers\Transport;

use App\Http\Controllers\Controller;
use App\Models\Transport;

class TransportController extends Controller
{

    public function index()
    {
        //
        $transports = Transport::all();

        return view('transport.index', [
            'transports' => $transports
        ]);
    }


}
