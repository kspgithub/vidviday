<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourQuestionsController extends Controller
{
    //
    public function faq(Tour $tour)
    {
        return view('admin.tour.tour-faq', ['tour' => $tour]);
    }


    public function questions(Tour $tour)
    {
        return view('admin.tour.questions', ['tour' => $tour]);
    }


    public function testimonials(Tour $tour)
    {
        return view('admin.tour.testimonials', ['tour' => $tour]);
    }
}
