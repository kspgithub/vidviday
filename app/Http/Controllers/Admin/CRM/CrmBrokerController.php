<?php

namespace App\Http\Controllers\Admin\CRM;

use App\Http\Controllers\Controller;
use App\Models\OrderBroker;
use Illuminate\Http\Request;

class CrmBrokerController extends Controller
{
    public function count(Request $request)
    {
        $status = $request->input('status', 'new');
        $query = OrderBroker::where('status', $status);
        return $query->count();
    }
}
