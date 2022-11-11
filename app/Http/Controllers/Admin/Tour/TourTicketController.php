<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;

class TourTicketController extends Controller
{
    //

    public function index(Tour $tour)
    {
        return view('admin.tour.ticket.index', ['tour' => $tour]);
    }
}
