<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourTicketController extends Controller
{
    //

    public function index(Tour $tour)
    {
        return view('admin.tour.tickets', ['tour' => $tour]);
    }
}
