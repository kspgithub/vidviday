<?php

namespace App\Http\Controllers\Admin\PopupAds;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PopupAd;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PopupAdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        //
        $advertisements = PopupAd::paginate(20);

        return view('admin.popup_ads.index', ['advertisements' => $advertisements]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        //
        $popupAd = new PopupAd();

        $pages = Page::toSelectBox('title', 'key');

        return view('admin.popup_ads.create', [
            'advertisement' => $popupAd,
            'pages' => $pages,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response|JsonResponse
     */
    public function store(Request $request)
    {
        //
        $popupAd = new PopupAd();
        $popupAd->fill($request->all());
        if ($request->hasFile('image_upload')) {
            $popupAd->deleteImage();
            $popupAd->uploadImage($request->file('image_upload'));
        }
        return redirect()->route('admin.popup_ads.edit', $popupAd)->withFlashSuccess(__('Record created'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param PopupAd $popupAd
     * @return View
     */
    public function edit(PopupAd $popupAd)
    {
        //
        $pages = Page::toSelectBox('title', 'key');

        return view('admin.popup_ads.edit', [
            'advertisement' => $popupAd,
            'pages' => $pages,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param PopupAd $popupAd
     * @return Response|JsonResponse
     */
    public function update(Request $request, PopupAd $popupAd)
    {
        //
        $popupAd->update($request->all());
        if ($request->hasFile('image_upload')) {
            $popupAd->deleteImage();
            $popupAd->uploadImage($request->file('image_upload'));
        }
        if ($request->ajax()) {
            return response()->json(['result' => 'success', 'message' => __('Record Updated')]);
        }
        return redirect()->route('admin.popup_ads.edit', $popupAd)->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PopupAd $popupAd
     * @return Response
     */
    public function destroy(PopupAd $popupAd)
    {
        //
        $popupAd->deleteImage();
        $popupAd->delete();
        return redirect()->route('admin.popup_ads.index')->withFlashSuccess(__('Record Deleted'));
    }
}
