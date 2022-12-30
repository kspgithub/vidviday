<?php

namespace App\Http\Controllers\Admin\Transport;

use App\Http\Controllers\Controller;
use App\Models\TransportDuration;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransportDurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $transportDurations = TransportDuration::query()->get();
        return view('admin.transport_duration.index', ['transportDurations'=>$transportDurations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $transportDuration = new TransportDuration();

        return view('admin.transport_duration.create', ['transportDuration'=>$transportDuration]);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $transportDuration = new TransportDuration();
        $transportDuration->fill($request->all());
        $transportDuration->save();
//        return redirect()->route('admin.transport_duration.edit', $transportDuration)->withFlashSuccess(__('Record Created'));
        return redirect()->route('admin.transport_duration.index')->withFlashSuccess(__('Record Created'));
    }

    /**
     *
     * @param TransportDuration  $transportDuration
     *
     * @return View
     */
    public function edit(TransportDuration  $transportDuration)
    {
        //
        return view('admin.transport_duration.edit', ['transportDuration'=>$transportDuration]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param TransportDuration $transportDuration
     *
     * @return Response|JsonResponse
     */
    public function update(Request $request, TransportDuration $transportDuration)
    {
        //
        $transportDuration->fill($request->all());
        $transportDuration->save();

        if ($request->ajax()) {
            return response()->json(['result' => 'success', 'message' => __('Record Updated')]);
        }
        return redirect()->route('admin.transport_duration.edit', $transportDuration)->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TransportDuration $transportDuration
     *
     * @return Response
     */
    public function destroy(TransportDuration $transportDuration)
    {
        //
        $transportDuration->delete();
        return redirect()->route('admin.transport_duration.index')->withFlashSuccess(__('Record Deleted'));
    }

}
