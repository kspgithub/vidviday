<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisualOption;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class VisualOptionsController extends Controller
{
    //
    public function index()
    {
        $visual_options = VisualOption::all();

        return view('admin.visual-options.index', ['visual_options'=>$visual_options]);
    }


    public function update(Request $request)
    {
        $options = $request->input('options', []);

        foreach ($options as $key => $value) {
            $option = VisualOption::query()->where('key', $key)->first();
            if ($option) {
                switch ($option->type) {
                    case VisualOption::TYPE_IMAGE:
                        $image = $request->file('options.' . $key . '_upload');
                        if($image instanceof UploadedFile) {
                            $fileName = $key . '.' . $image->extension();
                            $option->value = $image->storeAs('visual_options', $fileName,"public");
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

        VisualOption::clearCache();

        return redirect()->back()->with('success', __('Updated'));
    }
}
