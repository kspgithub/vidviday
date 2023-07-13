<?php

namespace App\Http\Controllers\Vacancy;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PopupAd;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Models\VisualOption;
use Storage;

class VacancyController extends Controller
{
    //

    public function index(Request $request)
    {
        $pageContent = Page::published()->where('key', 'vacancies')->firstOrFail();
        $vacancies = Vacancy::published()->orderBy('created_at', 'desc')->paginate(20);
        $popupAds = PopupAd::query()->forModel($pageContent)->get();
        $giftImage = VisualOption::where('key', 'gift_image')->first();

        return view('vacancy.index', [
            'pageContent'=>$pageContent,
            'vacancies'=>$vacancies,
            'popupAds'=>$popupAds,
            'giftImage'=> $giftImage->value ? Storage::url($giftImage->value) : '/img/gift-certificate.jpg',
        ]);
    }

    public function show($slug)
    {
        $pageContent = Page::published()->where('key', 'vacancies')->firstOrFail();
        $vacancy = Vacancy::findBySlugOrFail($slug);
        $popupAds = PopupAd::query()->forModel($pageContent)->get();
        $giftImage = VisualOption::where('key', 'gift_image')->first();

        return view('vacancy.show', [
            'pageContent'=>$pageContent,
            'vacancy'=>$vacancy,
            'popupAds'=>$popupAds,
            'giftImage'=> $giftImage->value ? Storage::url($giftImage->value) : '/img/gift-certificate.jpg',
        ]);
    }
}
