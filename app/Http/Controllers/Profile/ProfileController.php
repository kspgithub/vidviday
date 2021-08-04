<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //

    public function index()
    {
        return view('profile.index');
    }


    public function orders()
    {
        return view('profile.orders');
    }


    public function history()
    {
        return view('profile.history');
    }


    public function favourites()
    {
        return view('profile.favourites');
    }
}
