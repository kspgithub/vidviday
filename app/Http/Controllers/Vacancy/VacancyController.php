<?php

namespace App\Http\Controllers\Vacancy;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    //

    public function index()
    {
        $pageContent = Page::where('key', 'vacancies')->first();
        $vacancies = Vacancy::published()->orderBy('created_at', 'desc')->paginate(20);
        return view('vacancy.index', [
            'pageContent'=>$pageContent,
            'vacancies'=>$vacancies,
        ]);
    }

    public function show($slug)
    {
        $pageContent = Page::where('key', 'vacancies')->first();
        $vacancy = Vacancy::findBySlugOrFail($slug);
        return view('vacancy.show', [
            'pageContent'=>$pageContent,
            'vacancy'=>$vacancy,
        ]);
    }


}
