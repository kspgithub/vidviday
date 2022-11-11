<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadMediaRequest;
use App\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    //

    public function editor(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $location = $file->store('/public/uploads/editor');

            return response()->json(['result' => 'OK', 'location' => Storage::url($location)]);
        }
        abort(401, 'invalid file');

        return false;
    }

    public function mediaStore(UploadMediaRequest $request)
    {
        /**
         * @var Model $model
         */
        $model = app()->make($request->input('model_type', ['id' => $request->input('model_id')]));
        $model = $model->newQuery()->findOrFail($request->input('model_id'));
        $collection = $request->input('collection', 'default');
        /** @var Media $media */
        $media = $model->storeMedia($request->media_file, $collection);
        foreach ($request->get('custom_properties', []) as $key => $value) {
            if ($key === 'published') {
                $value = filter_var($value, FILTER_VALIDATE_BOOLEAN);
            }
            $media->setCustomProperty($key, $value);
        }
        $media->save();

        return response()->json(['result' => 'success', 'media' => $media->asAlpineData()]);
    }

    public function mediaUpdate(Request $request, Media $media)
    {
        $locale = $request->input('locale', app()->getLocale());

        if ($request->has('title')) {
            $media->setCustomProperty('title_'.$locale, $request->input('title', ''));
        }
        if ($request->has('alt')) {
            $media->setCustomProperty('alt_'.$locale, $request->input('alt', ''));
        }
        if ($request->has('published')) {
            $media->setCustomProperty('published', $request->input('published', ! $media->getCustomProperty('published', false)));
        }
        $media->save();

        return response()->json(['result' => 'success', 'media' => $media->asAlpineData()]);
    }

    public function mediaDelete(Media $media)
    {
        $media->delete();

        return response()->json(['result' => 'success', 'media' => $media->asAlpineData()]);
    }

    public function mediaOrder(Request $request)
    {
        $order = $request->input('order', []);
        Media::setNewOrder($order);

        return response()->json(['result' => 'success', 'media' => $order]);
    }
}
