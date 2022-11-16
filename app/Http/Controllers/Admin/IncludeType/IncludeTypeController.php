<?php

namespace App\Http\Controllers\Admin\IncludeType;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\IncludeType\IncludeTypeBasicRequest;
use App\Models\IncludeType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class IncludeTypeController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view("admin.include-type.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $includeType = new IncludeType();

        return view("admin.include-type.create", [
            "includeType" => $includeType
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param IncludeTypeBasicRequest $request
     *
     * @return mixed
     */
    public function store(IncludeTypeBasicRequest $request)
    {
        $includeType = new IncludeType();

        $includeType->fill($request->all());
        $includeType->save();

        return redirect()->route('admin.include-type.index', ["includeType" => $includeType])
                         ->withFlashSuccess(__('Record created.'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param IncludeType $includeType
     *
     * @return Application|Factory|View
     */
    public function edit(IncludeType $includeType)
    {
        return view("admin.include-type.edit", [
            "includeType" => $includeType
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param IncludeTypeBasicRequest $request
     *
     * @param IncludeType $includeType
     *
     * @return mixed
     *
     * @throws GeneralException
     */
    public function update(IncludeTypeBasicRequest $request, IncludeType $includeType)
    {
        $includeType->fill($request->all());
        $includeType->save();

        return redirect()->route('admin.include-type.index', $includeType)
                         ->withFlashSuccess(__('Record updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param IncludeType $includeType
     *
     * @return mixed
     */
    public function destroy(IncludeType $includeType)
    {
        $includeType->delete();

        return redirect()->route('admin.include-type.index')->withFlashSuccess(__('Record deleted.'));
    }
}
