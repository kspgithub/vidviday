<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LanguageLine;
use Illuminate\Http\Request;


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
        $line = LanguageLine::where('group', $request->group)->where('key', $request->key)->first();
        if (empty($line)) {
            $line = new LanguageLine();
        }
        $line->fill($request->all());
        $line->save();
        $return_to = $request->input('return_to', route('admin.translation.index'));
        return redirect($return_to)->withFlashSuccess(__('Record Created'));
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

        $return_to = $request->input('return_to', route('admin.translation.index'));
        return redirect($return_to)->withFlashSuccess(__('Record Updated'));
    }

    public function destroy(Request $request, LanguageLine $line)
    {
        $line->delete();
        $return_to = $request->input('return_to', route('admin.translation.index'));
        return redirect($return_to)->withFlashSuccess(__('Record Deleted'));
    }
}
