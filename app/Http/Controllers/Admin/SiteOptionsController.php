<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteOption;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

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

        foreach ($options as $key => $value) {
            $option = SiteOption::query()->where('key', $key)->first();
            if ($option) {
                switch ($option->type) {
                    case SiteOption::TYPE_IMAGE:
                        $image = $request->file('options.' . $key . '_upload');
                        if($image instanceof UploadedFile) {
                            $fileName = $key . '.' . $image->extension();
                            $option->value = $image->storeAs('site_options', $fileName,"public");
                        } elseif (empty($value)) {
                            $option->value = '';
                        }
                        break;
                    default:
                        $option->value = !empty($value) ? $value : '';
                }

                $option->save();
            }
        }

        SiteOption::clearCache();

        return redirect()->back()->with('success', __('Updated'));
    }
}
