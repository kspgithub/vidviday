<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CrmController extends Controller
{
    //

    public function contactUpdate(Request $request)
    {
        $token = '5si6la7p83cjm506nezwb4orwofzcqwk';
        Log::info('Contact Update', $request->all());
        return response()->json(['result'=>'OK']);
    }
}
