<?php

namespace App\Http\Controllers\Admin\Transport;

use App\Http\Controllers\Controller;
use App\Models\Transport;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $transports = Transport::query()->get();

        return view('admin.transport.index', ['transports' => $transports]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $transport = new Transport();

        return view('admin.transport.create', ['transport' => $transport]);
    }

    /**
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $transport = new Transport();
        $transport->fill($request->all());
        $transport->save();
        if ($request->hasFile('image_upload')) {
            $transport->uploadImage($request->file('image_upload'));
        }

        return redirect()->route('admin.transport.edit', $transport)->withFlashSuccess(__('Record Created'));
    }

    /**
     * @param  Transport  $transport
     * @return View
     */
    public function edit(Transport $transport)
    {
        //
        return view('admin.transport.edit', ['transport' => $transport]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Transport  $transport
     * @return Response|JsonResponse
     */
    public function update(Request $request, Transport $transport)
    {
        //
        $transport->fill($request->all());
        $transport->save();
        if ($request->hasFile('image_upload')) {
            $transport->deleteImage();
            $transport->uploadImage($request->file('image_upload'));
        }

        if ($request->ajax()) {
            return response()->json(['result' => 'success', 'message' => __('Record Updated')]);
        }

        return redirect()->route('admin.transport.edit', $transport)->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Transport  $transport
     * @return Response
     */
    public function destroy(Transport $transport)
    {
        //
        $transport->delete();

        return redirect()->route('admin.transport.index')->withFlashSuccess(__('Record Deleted'));
    }
}
