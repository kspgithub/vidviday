<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Models\Article;

use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ArticlePictureController extends Controller
{
    //
    public function index(Article $article)
    {
        return view('admin.article.pictures', ['article'=>$article]);
    }

    public function upload(Request $request, Article $article)
    {
        if ($request->hasFile('media_file')) {
            $media = $article->storeMedia($request->file('media_file'), 'pictures');

            return response()->json(['result'=>'success', 'media'=>[
                'id'=>$media->id,
                'url'=>$media->getUrl(),
                'thumb'=>$media->getUrl('thumb'),
            ]]);
        }

        return response()->json(['result'=>'error', 'message'=>'No file'], 400);
    }

    public function update(Request $request, Article $article, Media $media)
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

    public function delete(Article $article, Media $media)
    {
        $article->deleteMedia($media);

        return response()->json(['result'=>'success', 'media'=>$media]);
    }
}
