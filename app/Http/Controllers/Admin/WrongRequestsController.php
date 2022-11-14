<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WrongQuery;

class WrongRequestsController extends Controller
{
    public function index()
    {
        $wrongRequests = WrongQuery::query()->paginate();

        return view('admin.wrong_requests.index', [
            'wrongRequests' => $wrongRequests,
        ]);
    }
}
