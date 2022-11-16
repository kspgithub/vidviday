<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LanguageLine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class TranslationController extends Controller
{
    //

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = LanguageLine::query();
            $group = $request->input('group', '*');

            if(!empty($q) && $group !== '*') {
                $query->where('group', $group);
            }

            $q = $request->input('q', '');

            if (!empty($q)) {
                $query->where(function ($sq) use ($group, $q) {
                    $sq->jsonLike('text', "%$q%")->orWhere('key', 'LIKE', "%$q%");

                    if ($group === '*') {
                        $sq->orWhere(DB::raw('CONCAT(`group`, ".", `key`)'), 'LIKE', "%$q%");
                    }
                });
            }

            $order = explode(':', $request->input('order', 'key:asc'));
            $query->orderBy($order[0] ?? 'key', $order[1] ?? 'asc');
            return $query->paginate(20);
        }

        $groups = LanguageLine::select('group')->distinct()->pluck('group')->toArray();
        return view('admin.translation.index', ['groups' => $groups]);
    }

    public function create()
    {
        $line = new LanguageLine();
        $line->group = '*';
        $languages = config('site-settings.locale.languages');
        return view('admin.translation.create', ['line' => $line, 'languages' => $languages]);
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

        return view('admin.translation.edit', ['line' => $line, 'languages' => $languages]);
    }

    public function update(Request $request, LanguageLine $line)
    {
        $line->text = $request->text;
        $line->save();
        if ($request->ajax()) {
            return response()->json(['result' => 'success', 'model' => $line]);
        }
        $return_to = $request->input('return_to', route('admin.translation.index'));
        return redirect($return_to)->withFlashSuccess(__('Record Updated'));
    }

    public function destroy(Request $request, LanguageLine $line)
    {
        $line->delete();
        $return_to = $request->input('return_to', route('admin.translation.index'));
        return redirect($return_to)->withFlashSuccess(__('Record Deleted'));
    }


    public function publish(Request $request)
    {
        set_time_limit(120);
        Artisan::call('translations:publish --skip-import');
        $return_to = $request->input('return_to', back()->getTargetUrl());
        return redirect($return_to)->withFlashSuccess(__('Переклади опубліковано'));
    }
}
