<?php

namespace App\Http\Controllers\Admin\Direction;

use App\Http\Controllers\Controller;
use App\Models\Direction;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DirectionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $directions = Direction::query()->withCount(['media'])->get();
        //
        return view('admin.direction.index', ['directions'=>$directions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        //
        $direction = new Direction();

        return view('admin.direction.create', ['direction'=>$direction]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $direction = new Direction();
        $direction->fill($request->all());
        $direction->save();

        return redirect()->route('admin.direction.index')->withFlashSuccess(__('Direction created.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Direction $direction
     *
     * @return View
     */
    public function edit(Direction $direction)
    {
        //
        return view('admin.direction.edit', ['direction'=>$direction]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Direction $direction
     *
     * @return Response
     */
    public function update(Request $request, Direction $direction)
    {
        //
        $direction->fill($request->all());
        $direction->save();

        return redirect()->route('admin.direction.index')->withFlashSuccess(__('Direction updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Direction $direction
     *
     * @return Response
     */
    public function destroy(Direction $direction)
    {
        //
        $direction->delete();

        return redirect()->route('admin.direction.index')->withFlashSuccess(__('Direction deleted.'));
    }

    // Madia

    public function mediaIndex(Direction $direction)
    {
        return view('admin.direction.media', ['direction'=>$direction]);
    }

    public function mediaUpload(Request $request, Direction $direction)
    {
        if ($request->hasFile('media_file')) {
            $media = $direction->storeMedia($request->file('media_file'));

            return response()->json(['result'=>'success', 'media'=>[
                'id'=>$media->id,
                'url'=>$media->getUrl(),
                'thumb'=>$media->getUrl('thumb'),
            ]]);
        }

        return response()->json(['result'=>'error', 'message'=>'No file'], 400);
    }

    public function mediaRemove(Direction $direction, Media $media)
    {
        $direction->deleteMedia($media);

        return response()->json(['result'=>'success', 'media'=>$media]);
    }
}
