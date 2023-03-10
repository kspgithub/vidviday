<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $pageContent = Page::published()->where('key', 'calendar')->firstOrFail();

        return view('calendar.index', [
            'pageContent' => $pageContent,
        ]);
    }
}
