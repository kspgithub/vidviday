<?php

namespace App\Http\Controllers\Charity;

use App\Http\Controllers\Controller;
use App\Models\Charity;
use App\Models\Page;
use Illuminate\Http\Request;

class CharityController extends Controller
{
    public function index()
    {

        $charity = Charity::published()->orderBy('id', 'desc')->paginate(9);
        $pageContent = Page::where('key', 'charity')->first();

        return view("charity.index", [
            "pageContent" => $pageContent,
            "charity" => $charity,
        ]);
    }

    public function single($slug)
    {

        $charitySingle = Charity::findBySlugOrFail($slug);

        return view("charity.single", [
            "charitySingle" => $charitySingle,
        ]);
    }

}
