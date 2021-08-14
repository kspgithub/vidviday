<?php

namespace App\Http\Controllers\Admin\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class EventPictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Event $event
     *
     * @return Application|Factory|View
     */
    public function index(Event $event)
    {
        return view('admin.event.pictures', ['event'=> $event]);
    }

    /**
     * @param Request $request
     *
     * @param Event $event
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     *
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     *
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function upload(Request $request, Event $event)
    {
        if ($request->hasFile('media_file')) {
            $media = $event->storeMedia($request->file('media_file'), 'pictures');

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
     * @param Event $event
     *
     * @param Media $media
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Event $event, Media $media)
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
     * @param Event $event
     *
     * @param Media $media
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\MediaCannotBeDeleted
     */
    public function delete(Event $event, Media $media)
    {
        $event->deleteMedia($media);

        return response()->json(['result'=>'success', 'media'=>$media]);
    }
}
