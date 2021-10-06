<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Models\AccommodationType;
use App\Models\Tour;
use App\Models\TourAccommodation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TourAccommController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|View
     */
    public function index(Tour $tour)
    {
        return view('admin.tour-accommodation.index', [
            'tour' => $tour,
        ]);
    }
    
}
