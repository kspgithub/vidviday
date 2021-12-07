<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TourPictureController extends Controller
{
    //
    public function index(Tour $tour)
    {
        return view('admin.tour.pictures', ['tour'=>$tour]);
    }

}
