<?php

namespace App\Http\Controllers\Admin\HomePageBanner;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\HomePageBanner\HomePageBannerBasicRequest;
use App\Models\Currency;
use App\Models\HomePageBanner;
use App\Services\HomePageBannerService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomePageBannerController extends Controller
{
    protected $service;

    public function __construct(HomePageBannerService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.home-page-banner.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $homePageBanner = new HomePageBanner();

        $homePageBanner->currency = 'UAH';

        $currencies = Currency::toSelectBox('iso', 'iso');

        return view('admin.home-page-banner.create', [
            'homePageBanner' => $homePageBanner,
            'currencies' => $currencies,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param HomePageBannerBasicRequest $request
     *
     * @return mixed
     */
    public function store(HomePageBannerBasicRequest $request)
    {
        $homePageBanner = $this->service->store($request->validated());

        return redirect()->route('admin.home-page-banner.picture.index', ['homePageBanner' => $homePageBanner])
                         ->withFlashSuccess(__('Record created.'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param HomePageBanner $homePageBanner
     *
     * @return Application|Factory|View
     */
    public function edit(HomePageBanner $homePageBanner)
    {
        $currencies = Currency::toSelectBox('iso', 'iso');

        return view('admin.home-page-banner.edit', [
            'homePageBanner' => $homePageBanner,
            'currencies' => $currencies,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param HomePageBannerBasicRequest $request
     *
     * @param HomePageBanner $homePageBanner
     *
     * @return mixed
     *
     * @throws GeneralException
     */
    public function update(HomePageBannerBasicRequest $request, HomePageBanner $homePageBanner)
    {
        $this->service->update($homePageBanner, $request->validated());

        return redirect()->route('admin.home-page-banner.edit', $homePageBanner)
                         ->withFlashSuccess(__('Record updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param HomePageBanner $homePageBanner
     * @return mixed
     */
    public function destroy(HomePageBanner $homePageBanner)
    {
        $homePageBanner->delete();

        return redirect()->route('admin.home-page-banner.index')->withFlashSuccess(__('Record deleted.'));
    }
}
