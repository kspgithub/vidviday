<?php

namespace App\Http\Controllers\Admin\CRM;

use App\Http\Controllers\Controller;
use App\Models\OrderCertificate;
use Illuminate\Http\Request;

class CrmCertificateController extends Controller
{
    public function count(Request $request)
    {
        $status = $request->input('status', 'new');
        $query = OrderCertificate::where('status', $status);
        return $query->count();
    }
}
