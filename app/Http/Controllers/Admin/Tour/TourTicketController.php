<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\Ticket;
use App\Models\Tour;
use App\Models\TourTicket;
use Illuminate\Http\Request;

class TourTicketController extends Controller
{
    //

    public function index(Tour $tour)
    {
        return view('admin.tour.ticket.index', ['tour' => $tour]);
    }
}
