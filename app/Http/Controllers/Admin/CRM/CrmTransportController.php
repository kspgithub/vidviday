<?php

namespace App\Http\Controllers\Admin\CRM;

use App\Http\Controllers\Controller;
use App\Models\OrderTransport;
use Illuminate\Http\Request;

class CrmTransportController extends Controller
{
    public function count(Request $request)
    {
        $status = $request->input('status', 'new');
        $query = OrderTransport::where('status', $status);

        return $query->count();
    }
}
