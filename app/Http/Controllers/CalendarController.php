<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\VisualOption;
use Storage;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $pageContent = Page::published()->where('key', 'calendar')->firstOrFail();
        $giftImage = VisualOption::where('key', 'gift_image')->first();

        return view('calendar.index', [
            'pageContent' => $pageContent,
            'giftImage' => $giftImage->value ? Storage::url($giftImage->value) : '/img/gift-certificate.jpg',
        ]);
    }
}
