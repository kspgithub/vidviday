<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transport;
use Illuminate\Http\Request;

class TransportController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $transports = Transport::query()->withCount(['media'])->get();
        return view('admin.transport.index', ['transports'=>$transports]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $transport = new Transport();

        return view('admin.transport.create', ['transport'=>$transport]);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $transport = new Transport();
        $transport->fill($request->all());
        $transport->save();

        return redirect()->route('admin.transport.index')->withFlashSuccess(__('Transport created.'));
    }

    /**
     *
     * @param Transport  $transport
     *
     * @return View
     */
    public function edit(Transport  $transport)
    {
        //
        return view('admin.transport.edit', ['transport'=>$transport]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Transport  $transport
     *
     * @return Response
     */
    public function update(Request $request, Transport $transport)
    {
        //
        $transport->fill($request->all());
        $transport->save();

        return redirect()->route('admin.transport.index')->withFlashSuccess(__('Transport updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Transport $transport
     *
     * @return Response
     */
    public function destroy(Transport $transport)
    {
        //
        $transport->delete();

        return redirect()->route('admin.transport.index')->withFlashSuccess(__('Transport deleted.'));
    }

    public function mediaIndex(Transport $transport)
    {
        return view('admin.transport.media', ['transport'=>$transport]);
    }

    public function mediaUpload(Request $request, Transport $transport)
    {
        if ($request->hasFile('media_file')) {
            $media = $transport->storeMedia($request->file('media_file'));

            return response()->json(['result'=>'success', 'media'=>[
                'id'=>$media->id,
                'url'=>$media->getUrl(),
                'thumb'=>$media->getUrl('thumb'),
            ]]);
        }

        return response()->json(['result'=>'error', 'message'=>'No file'], 400);
    }

    public function mediaUpdate(Request $request, Transport $transport, Media $media)
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


    public function mediaRemove(Transport $transport, Media $media)
    {
        $transport->deleteMedia($media);

        return response()->json(['result'=>'success', 'media'=>$media]);
    }
}
