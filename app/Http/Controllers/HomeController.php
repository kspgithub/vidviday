<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    //

    public function index()
    {
        $tours = Tour::search()->paginate(12);

        return view('home.index', ['tours' => $tours]);
    }
}
