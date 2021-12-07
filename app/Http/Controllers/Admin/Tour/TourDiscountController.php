<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Tour;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TourDiscountController extends Controller
{
    /**
     * Display a listing of the resource discounts.
     *
     * @param Tour $tour
     *
     * @return Application|Factory|View
     */
    public function index(Tour $tour)
    {

        return view('admin.tour.discounts', ['tour' => $tour]);
    }
}
