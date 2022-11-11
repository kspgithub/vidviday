<?php

namespace App\Http\Controllers\Admin\Charity;

use App\Http\Controllers\Controller;
use App\Http\Requests\Charity\CharityBasicRequest;
use App\Models\Charity;
use App\Services\CharityService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CharityController extends Controller
{
    protected $service;

    public function __construct(CharityService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource
     *
     * @return Application|Factory|View|JsonResponse
     */
    public function index()
    {
        return view('admin.charity.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $charity = new Charity();

        return view('admin.charity.create', [
            'charity' => $charity,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CharityBasicRequest  $request
     *
     * @return JsonResponse|RedirectResponse
     */
    public function store(CharityBasicRequest $request)
    {
        $charity = $this->service->store($request->validated());

        return redirect()->route('admin.charity.edit', $charity)->withFlashSuccess(__('Record Created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Charity  $charity
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit(Charity $charity)
    {
        return view('admin.charity.edit', [
            'charity' => $charity,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CharityBasicRequest  $request
     * @param Charity  $charity
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return mixed
     */
    public function update(CharityBasicRequest $request, Charity $charity)
    {
        $this->service->update($charity, $request->validated());

        return redirect()->route('admin.charity.edit', $charity)->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Charity  $charity
     *
     * @return mixed
     */
    public function destroy(Charity $charity)
    {
        $charity->delete();

        return redirect()->route('admin.charity.index')->withFlashSuccess(__('Record Deleted'));
    }

    /**
     * Update status the specified resource.
     *
     * @param Request  $request
     * @param Charity  $charity
     *
     * @return JsonResponse
     */
    public function updateStatus(Request $request, Charity $charity)
    {
        $charity->published = (int) $request->input('published');
        $charity->save();

        return response()->json(['result' => 'success']);
    }
}
