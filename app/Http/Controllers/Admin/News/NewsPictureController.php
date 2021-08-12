<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class NewsPictureController extends Controller
{

    public function index(News $news)
    {
        return view('admin.news.pictures', ['news'=>$news]);
    }

    public function upload(Request $request, News $news)
    {
        if ($request->hasFile('media_file')) {
            $media = $news->storeMedia($request->file('media_file'), 'pictures');

            return response()->json(['result'=>'success', 'media'=>[
                'id'=>$media->id,
                'url'=>$media->getUrl(),
                'thumb'=>$media->getUrl('thumb'),
            ]]);
        }

        return response()->json(['result'=>'error', 'message'=>'No file'], 400);
    }

    public function update(Request $request, News $news, Media $media)
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

    public function delete(News $news, Media $media)
    {
        $news->deleteMedia($media);

        return response()->json(['result'=>'success', 'media'=>$media]);
    }
}
