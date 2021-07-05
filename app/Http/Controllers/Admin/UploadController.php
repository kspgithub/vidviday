<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadMediaRequest;
use Illuminate\Database\Eloquent\Model;
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

    public function mediaStore(UploadMediaRequest $request)
    {
        /**
         * @var Model $model
         */
        $model = app()->make($request->input('model_type', ['id'=>$request->input('model_id')]));
        $model = $model->newQuery()->findOrFail($request->input('model_id'));

        $media = $model->storeMedia($request->media_file);
        $media->save();

        return response()->json(['result'=>'success', 'media'=>[
            'id'=>$media->id,
            'url'=>$media->getUrl(),
            'thumb'=>$media->getUrl('thumb'),
        ]]);
    }

    public function mediaUpdate(Request $request, Media $media)
    {
        if ($request->has('title')) {
            $media->setCustomProperty('title_'.app()->getLocale(), $request->input('title', ''));
        }
        if ($request->has('alt')) {
            $media->setCustomProperty('alt_'.app()->getLocale(), $request->input('alt', ''));
        }
        $media->save();

        return response()->json(['result'=>'success', 'media'=>$media]);
    }

    public function mediaDelete(Media $media)
    {
        $media->delete();

        return response()->json(['result'=>'success', 'media'=>$media]);
    }
}
