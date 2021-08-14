<?php

namespace App\Http\Controllers\Admin\HomePageBanner;

use App\Http\Controllers\Controller;
use App\Models\HomePageBanner;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class HomePageBannerPictureController extends Controller
{
    /**
     * @param HomePageBanner $homePageBanner
     *
     * @return Application|Factory|View
     */
    public function index(HomePageBanner $homePageBanner)
    {
        return view('admin.home-page-banner.pictures', ['homePageBanner' => $homePageBanner]);
    }

    /**
     * @param Request $request
     *
     * @param HomePageBanner $homePageBanner
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     *
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     *
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function upload(Request $request, HomePageBanner $homePageBanner)
    {
        if ($request->hasFile('media_file')) {
            $media = $homePageBanner->storeMedia($request->file('media_file'), 'pictures');

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
     * @param HomePageBanner $homePageBanner
     *
     * @param Media $media
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, HomePageBanner $homePageBanner, Media $media)
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
     * @param HomePageBanner $homePageBanner
     *
     * @param Media $media
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\MediaCannotBeDeleted
     */
    public function delete(HomePageBanner $homePageBanner, Media $media)
    {
        $homePageBanner->deleteMedia($media);

        return response()->json(['result'=>'success', 'media'=>$media]);
    }
}
