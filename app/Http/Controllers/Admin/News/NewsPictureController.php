<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class NewsPictureController extends Controller
{
    /**
     * @param News $news
     * @return Application|Factory|View
     */
    public function index(News $news)
    {
        return view('admin.news.pictures', ['news'=>$news]);
    }

    /**
     * @param Request $request
     *
     * @param News $news
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     *
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     *
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
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

    /**
     * @param Request $request
     *
     * @param News $news
     *
     * @param Media $media
     *
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * @param News $news
     *
     * @param Media $media
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\MediaCannotBeDeleted
     */
    public function delete(News $news, Media $media)
    {
        $news->deleteMedia($media);

        return response()->json(['result'=>'success', 'media'=>$media]);
    }
}
