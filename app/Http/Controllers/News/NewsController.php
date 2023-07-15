<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\VisualOption;
use Storage;


class NewsController extends Controller
{
    public function index()
    {

        $news = News::published()->orderBy('created_at', 'desc')->paginate(9);
        $pageContent = Page::published()->where('key', 'news')->firstOrFail();
        $giftImage = VisualOption::where('key', 'gift_image')->first();

        return view("news.index", [
            "pageContent" => $pageContent,
            "news" => $news,
            'giftImage' => $giftImage->value ? Storage::url($giftImage->value) : '/img/gift-certificate.jpg',
        ]);
    }

    public function single($slug)
    {

        $newsSingle = News::query()->published()->whereHasSlug($slug)->firstOrFail();
        $giftImage = VisualOption::where('key', 'gift_image')->first();

        return view("news.single", [
            "newsSingle" => $newsSingle,
            'giftImage' => $giftImage->value ? Storage::url($giftImage->value) : '/img/gift-certificate.jpg',
        ]);
    }

}
