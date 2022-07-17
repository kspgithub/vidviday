<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tour\TourBasicRequest;
use App\Models\Badge;
use App\Models\Currency;
use App\Models\Direction;
use App\Models\EventItem;
use App\Models\Staff;
use App\Models\Tour;
use App\Models\TourGroup;
use App\Models\TourSubject;
use App\Models\TourType;
use App\Services\TourService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TourVotingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Tour $tour)
    {
        //
        return view('admin.tour.voting.index', [
            'tour' => $tour,
        ]);
    }
}
