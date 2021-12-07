<?php

namespace App\Http\Controllers\Admin\OurClient;

use App\Http\Controllers\Controller;
use App\Models\OurClient;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OurClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        //
        $clients = OurClient::query()->orderBy('position')->get();
        return view('admin.our-clients.index', ['clients'=>$clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        //
        $ourClient = new OurClient();
        return view('admin.our-clients.create', ['ourClient'=>$ourClient]);
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
        $ourClient = new OurClient();
        $ourClient->fill($request->all());
        $ourClient->save();
        if ($request->hasFile('image_upload')) {
            $ourClient->uploadImage($request->file('image_upload'));
        }

        return redirect()->route('admin.our-client.edit', $ourClient)->withFlashSuccess(__('Record Created'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param OurClient $ourClient
     * @return View
     */
    public function edit(OurClient $ourClient)
    {
        //
        return view('admin.our-clients.edit', ['ourClient'=>$ourClient]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param OurClient $ourClient
     * @return Response
     */
    public function update(Request $request, OurClient $ourClient)
    {
        //
        $ourClient->fill($request->all());
        $ourClient->save();
        if ($request->hasFile('image_upload')) {
            $ourClient->uploadImage($request->file('image_upload'));
        }

        return redirect()->route('admin.our-client.edit', $ourClient)->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param OurClient $ourClient
     * @return Response
     */
    public function destroy(OurClient $ourClient)
    {
        //
        $ourClient->deleteImage();
        $ourClient->delete();
        return redirect()->route('admin.our-client.index')->withFlashSuccess(__('Record Deleted'));
    }
}
