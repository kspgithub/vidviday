<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\TranslationLoader\LanguageLine;

class TranslationController extends Controller
{
    //

    public function index()
    {
        return view('admin.translation.index', ['sorts' => ['key' => 'asc']]);
    }

    public function create()
    {
        $line = new LanguageLine();
        $line->group = '*';
        $languages = config('site-settings.locale.languages');

        return view('admin.translation.create', ['line' => $line, 'languages'=>$languages]);
    }

    public function store(Request $request)
    {
        LanguageLine::create($request->all());

        return redirect()->route('admin.translation.index')->withFlashSuccess(__('Record Created'));
    }

    public function edit(LanguageLine $line)
    {
        $languages = config('site-settings.locale.languages');

        return view('admin.translation.edit', ['line' => $line, 'languages'=>$languages]);
    }

    public function update(Request $request, LanguageLine $line)
    {
        $line->text = $request->text;
        $line->save();

        return redirect()->route('admin.translation.index')->withFlashSuccess(__('Record Updated'));
    }

    public function destroy(LanguageLine $line)
    {
        $line->delete();

        return redirect()->route('admin.translation.index')->withFlashSuccess(__('Record Deleted'));
    }
}
