<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UploadController extends Controller
{
    //

    public function editor(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $location = $file->store("/uploads/editor", 'public');

            return response()->json(['result'=>'OK', 'location'=>Storage::url($location)]);
        }
        abort(401, 'invalid file');
    }

    public function removeMedia(Media $media)
    {
        $media->delete();

        return ['result'=>'success', 'media'=>$media];
    }
}
