<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TourPictureController extends Controller
{
    //
    public function index(Tour $tour)
    {
        return view('admin.tour.pictures', ['tour'=>$tour]);
    }

    public function upload(Request $request, Tour $tour)
    {
        if ($request->hasFile('media_file')) {
            $media = $tour->storeMedia($request->file('media_file'), 'pictures');

            return response()->json(['result'=>'success', 'media'=>[
                'id'=>$media->id,
                'url'=>$media->getUrl(),
                'thumb'=>$media->getUrl('thumb'),
            ]]);
        }

        return response()->json(['result'=>'error', 'message'=>'No file'], 400);
    }

    public function update(Request $request, Tour $tour, Media $media)
    {
        if($request->has('title')) {
            $media->setCustomProperty('title_'.app()->getLocale(), $request->input('title', ''));
        }
        if($request->has('alt')) {
            $media->setCustomProperty('alt_'.app()->getLocale(), $request->input('alt', ''));
        }
        $media->save();
        return response()->json(['result'=>'success', 'media'=>$media]);
    }

    public function delete(Tour $tour, Media $media)
    {
        $tour->deleteMedia($media);

        return response()->json(['result'=>'success', 'media'=>$media]);
    }
}
