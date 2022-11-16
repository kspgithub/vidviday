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
        $activeTabs = $tour->active_tabs;
        $requestTabs = $request->get('active_tabs');
        $index = array_search('hutsul_fun', $activeTabs);
        if(in_array('hutsul_fun', $requestTabs)) {
            foreach ($tour->locales as $locale) {
                if(!$request->filled('hutsul_fun_title.' . $locale)) {
                    return redirect()->back()->withErrors([
                        'active_tabs' => 'Заповніть поля, щоб включити вкладку "Гуцульська забава"',
                    ])->withInput(['active_tabs' => []]);
                }
            }

            if($index === false) {
                $activeTabs[] = 'hutsul_fun';
            }
        } else {
            if($index !== false) {
                array_splice($activeTabs, $index);
            }
        }
        $tour->fill(['active_tabs' => array_filter($activeTabs)]);
        $tour->fill($request->only(['hutsul_fun_title', 'hutsul_fun_text']));
        $tour->save();
        return redirect()->route('admin.tour.hutsul-fun.index', $tour)->withFlashSuccess(__('Updated'));
    }
}
