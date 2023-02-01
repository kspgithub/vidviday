<?php

namespace App\Http\Controllers\Admin\Banner;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.banner.index', [

        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        //
        $banner = new Banner();
        $banner->show_price = true;
        return view('admin.banner.create', ['banner'=>$banner]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'image_upload' => ['nullable', 'file', 'max:500']
        ]);
        $banner = new Banner();
        $banner->fill($request->all());
        $banner->save();
        if ($request->hasFile('image_upload')) {
            $banner->uploadImage($request->file('image_upload'));
        }
        return redirect()->route('admin.banner.edit', $banner)->withFlashSuccess(__('Record Created'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Banner $banner
     * @return View
     */
    public function edit(Banner $banner)
    {
        //
        return view('admin.banner.edit', ['banner'=>$banner]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Banner $banner
     * @return Response|JsonResponse
     */
    public function update(Request $request, Banner $banner)
    {
        //
        $this->validate($request, [
            'image_upload' => ['nullable', 'file', 'max:500']
        ]);
        $banner->fill($request->all());
        $banner->save();
        if ($request->hasFile('image_upload')) {
            $banner->deleteImage();
            $banner->uploadImage($request->file('image_upload'));
        }
        if ($request->ajax()) {
            return response()->json(['result'=>'success', 'message'=>__('Record Updated')]);
        }
        return redirect()->route('admin.banner.edit', $banner)->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Banner $banner
     * @return Response
     */
    public function destroy(Banner $banner)
    {
        //
        $banner->deleteImage();
        $banner->delete();
        return redirect()->route('admin.banner.index')->withFlashSuccess(__('Record Deleted'));
    }

    /**
     * Update status the specified resource.
     *
     * @param Request $request
     * @param Banner $banner
     * @return JsonResponse
     */
    public function updateStatus(Request $request, Banner $banner)
    {
        $banner->published = (int)$request->input('published');
        $banner->save();
        return response()->json(['result' => 'success']);
    }
}
