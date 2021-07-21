<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Badge;
use Illuminate\Http\Request;

class BadgeController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $badgesPrepeared = Badge::query();
        $badgesPaginated = $badgesPrepeared->paginate(20);
        $badges = $badgesPrepeared->get();//->sortBy('region_id');

        //
        return view('admin.badge.index', ['badges'=>$badges, 'badgesPaginated'=>$badgesPaginated]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $badge = new Badge();

        return view('admin.badge.create', ['badge'=>$badge]);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $badge = new Badge();
        $badge->fill($request->all());
        $badge->save();

        return redirect()->route('admin.badge.index')->withFlashSuccess(__('Badge created.'));
    }

    /**
     *
     * @param Badge  $badge
     *
     * @return View
     */
    public function edit(Badge  $badge)
    {
        //
        return view('admin.badge.edit', ['badge'=>$badge]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Badge  $badge
     *
     * @return Response
     */
    public function update(Request $request, Badge $badge)
    {
        //
        $badge->fill($request->all());
        $badge->save();

        return redirect()->route('admin.badge.index')->withFlashSuccess(__('Badge updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Badge $badge
     *
     * @return Response
     */
    public function destroy(Badge $badge)
    {
        //
        $badge->delete();

        return redirect()->route('admin.badge.index')->withFlashSuccess(__('Badge deleted.'));
    }

    public function mediaIndex(Badge $badge)
    {
        return view('admin.badge.media', ['badge'=>$badge]);
    }

    public function mediaUpload(Request $request, Badge $badge)
    {
        if ($request->hasFile('media_file')) {
            $media = $badge->storeMedia($request->file('media_file'));

            return response()->json(['result'=>'success', 'media'=>[
                'id'=>$media->id,
                'url'=>$media->getUrl(),
                'thumb'=>$media->getUrl('thumb'),
            ]]);
        }

        return response()->json(['result'=>'error', 'message'=>'No file'], 400);
    }

    public function mediaUpdate(Request $request, Badge $badge, Media $media)
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


    public function mediaRemove(Badge $badge, Media $media)
    {
        $badge->deleteMedia($media);

        return response()->json(['result'=>'success', 'media'=>$media]);
    }
}
