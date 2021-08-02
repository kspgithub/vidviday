<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Services\TourScheduleService;
use Illuminate\Contracts\View\View;

class TourScheduleController extends Controller
{
    protected $service;

    public function __construct(TourScheduleService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Tour $tour)
    {
        //
        return view('admin.tour-schedule.index', ['tour' => $tour]);
    }

}
