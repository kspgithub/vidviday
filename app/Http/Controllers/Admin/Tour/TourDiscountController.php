<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class TourDiscountController extends Controller
{
    /**
     * Display a listing of the resource discounts.
     *
     * @param Tour  $tour
     *
     * @return Application|Factory|View
     */
    public function index(Tour $tour)
    {
        return view('admin.tour.discount.index', ['tour' => $tour]);
    }
}
