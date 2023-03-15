<?php

namespace App\Http\Controllers\Vacancy;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PopupAd;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    //

    public function index(Request $request)
    {
        $pageContent = Page::published()->where('key', 'vacancies')->firstOrFail();
        $vacancies = Vacancy::published()->orderBy('created_at', 'desc')->paginate(20);
        $popupAds = PopupAd::query()->forModel($pageContent)->get();

        return view('vacancy.index', [
            'pageContent'=>$pageContent,
            'vacancies'=>$vacancies,
            'popupAds'=>$popupAds,
        ]);
    }

    public function show($slug)
    {
        $pageContent = Page::published()->where('key', 'vacancies')->firstOrFail();
        $vacancy = Vacancy::findBySlugOrFail($slug);
        $popupAds = PopupAd::query()->forModel($pageContent)->get();

        return view('vacancy.show', [
            'pageContent'=>$pageContent,
            'vacancy'=>$vacancy,
            'popupAds'=>$popupAds,
        ]);
    }
}
