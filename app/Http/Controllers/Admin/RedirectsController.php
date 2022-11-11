<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RedirectsRequest;
use App\Models\Redirect;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class RedirectsController extends Controller
{
    //
    public function index()
    {
        $redirects = Redirect::all();

        $redirectTypes = [
            [
                'value' => Redirect::TYPE_FULL,
                'text' => 'Full',
            ],
            [
                'value' => Redirect::TYPE_PARTIAL,
                'text' => 'Partial',
            ],
            [
                'value' => Redirect::TYPE_REGEX,
                'text' => 'Regex',
            ],
        ];

        return view('admin.redirects.index', [
            'redirects' => $redirects,
            'redirectTypes' => $redirectTypes,
        ]);
    }

    public function update(RedirectsRequest $request)
    {
        $data = $request->validated();

        $ids = array_filter(Arr::pluck($data['redirects'], 'id'));

        Redirect::query()->whereNotIn('id', $ids)->delete();

        foreach ($data['redirects'] as $item) {
            if ($id = ($item['id'] ?? false)) {
                $redirect = Redirect::query()->find($id);
            } else {
                $redirect = new Redirect();
            }

            $redirect->fill($item);
            $redirect->save();
        }

        Cache::forget('redirects');

        return redirect()->back()->with('success', __('Updated'));
    }
}
