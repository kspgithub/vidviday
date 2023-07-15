<?php

namespace App\Http\Controllers\Charity;

use App\Http\Controllers\Controller;
use App\Models\Charity;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\VisualOption;
use Storage;


class CharityController extends Controller
{
    public function index()
    {

        $charity = Charity::published()->orderBy('id', 'desc')->paginate(9);
        $pageContent = Page::published()->where('key', 'charity')->firstOrFail();
        $giftImage = VisualOption::where('key', 'gift_image')->first();


        return view("charity.index", [
            "pageContent" => $pageContent,
            "charity" => $charity,
            'giftImage' => $giftImage->value ? Storage::url($giftImage->value) : '/img/gift-certificate.jpg',
        ]);
    }

    public function single($slug)
    {

        $charitySingle = Charity::findBySlugOrFail($slug);
        $giftImage = VisualOption::where('key', 'gift_image')->first();


        return view("charity.single", [
            "charitySingle" => $charitySingle,
            'giftImage' => $giftImage->value ? Storage::url($giftImage->value) : '/img/gift-certificate.jpg',
        ]);
    }

}
