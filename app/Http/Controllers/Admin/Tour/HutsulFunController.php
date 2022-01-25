<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;

class HutsulFunController extends Controller
{
    //
    public function index(Tour $tour)
    {

        $titles = $tour->getTranslations('hutsul_fun_title') ?? [];
        $translations = $tour->getTranslations('hutsul_fun_text') ?? [];
        return view('admin.tour.hutsul-fun', [
            'tour' => $tour,
            'titles' => $titles,
            'translations' => $translations
        ]);

    }

    public function update(Request $request, Tour $tour)
    {
        $tour->fill($request->only(['hutsul_fun_on', 'hutsul_fun_title', 'hutsul_fun_text']));
        $tour->save();
        return redirect()->route('admin.tour.hutsul-fun.index', $tour)->withFlashSuccess(__('Updated'));
    }
}
