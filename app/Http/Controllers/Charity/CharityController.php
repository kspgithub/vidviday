<?php

namespace App\Http\Controllers\Charity;

use App\Http\Controllers\Controller;
use App\Models\Charity;
use App\Models\Page;

class CharityController extends Controller
{
    public function index()
    {
        $charity = Charity::published()->orderBy('id', 'desc')->paginate(9);
        $pageContent = Page::published()->where('key', 'charity')->firstOrFail();

        return view('charity.index', [
            'pageContent' => $pageContent,
            'charity' => $charity,
        ]);
    }

    public function single($slug)
    {
        $charitySingle = Charity::findBySlugOrFail($slug);

        return view('charity.single', [
            'charitySingle' => $charitySingle,
        ]);
    }
}
