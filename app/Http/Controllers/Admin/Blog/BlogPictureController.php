<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Exceptions\MediaCannotBeDeleted;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BlogPictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Blog $blog
     *
     * @return Application|Factory|View
     */
    public function index(Blog $blog)
    {
        return view('admin.blog.pictures', [
            "blog" => $blog,
        ]);
    }

    /**
     * @param Request $request
     *
     * @param Blog $blog
     *
     * @return JsonResponse
     *
     * @throws InvalidManipulation
     *
     * @throws FileDoesNotExist
     *
     * @throws FileIsTooBig
     */
    public function upload(Request $request, Blog $blog)
    {

        if ($request->hasFile('media_file')) {
            $media = $blog->storeMedia($request->file('media_file'), 'pictures');

            return response()->json([
                'result' => 'success',
                'media' => [
                'id' => $media->id,
                'url' => $media->getUrl(),
                'thumb' => $media->getUrl('thumb'),
                ]
            ]);
        }

        return response()->json(['result' => 'error', 'message' => 'No file'], 400);
    }

    /**
     * @param Request $request
     *
     * @param Blog $blog
     *
     * @param Media $media
     *
     * @return JsonResponse
     */
    public function update(Request $request, Blog $blog, Media $media)
    {

        if ($request->has('title')) {
            $media->setCustomProperty('title_'.app()->getLocale(), $request->input('title', ''));
        }
        if ($request->has('alt')) {
            $media->setCustomProperty('alt_'.app()->getLocale(), $request->input('alt', ''));
        }

        $media->save();

        return response()->json([
            'result' => 'success',
            'media' => $media
        ]);
    }

    /**
     * @param Blog $blog
     *
     * @param Media $media
     *
     * @return JsonResponse
     *
     * @throws MediaCannotBeDeleted
     */
    public function delete(Blog $blog, Media $media)
    {
        $blog->deleteMedia($media);

        return response()->json([
            'result' => 'success',
            'media' => $media
        ]);
    }
}
