<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteOption;
use Illuminate\Http\Request;

class SiteOptionsController extends Controller
{
    //
    public function index()
    {
        $site_options = SiteOption::all();

        return view('admin.site-options.index', ['site_options'=>$site_options]);
    }


    public function update(Request $request)
    {
        $options = $request->input('options', []);

        foreach ($options as $key=>$value) {
            $option = SiteOption::query()->where('key', $key)->first();
            if ($option) {
                $option->value = $value;
                $option->save();
            }
        }


        SiteOption::clearCache();

        return redirect()->back()->with('success', __('Updated'));
    }
}
