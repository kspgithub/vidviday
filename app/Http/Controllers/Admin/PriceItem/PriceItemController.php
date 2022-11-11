<?php

namespace App\Http\Controllers\Admin\PriceItem;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\PriceItem\PriceItemBasicRequest;
use App\Models\Currency;
use App\Models\PriceItem;
use App\Models\Tour;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PriceItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.price-item.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $priceItem = new PriceItem();

        $priceItem->currency = 'UAH';

        $currencies = Currency::toSelectBox('iso', 'iso');

        $tours = Tour::toSelectBox('title', 'id');

        return view('admin.price-item.create', [
            'priceItem' => $priceItem,
            'currencies' => $currencies,
            'tours' => $tours,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PriceItemBasicRequest  $request
     * @return mixed
     */
    public function store(PriceItemBasicRequest $request)
    {
        $priceItem = new PriceItem();

        $priceItem->fill($request->all());
        $priceItem->save();

        return redirect()->route('admin.price-item.index', ['priceItem' => $priceItem])
                         ->withFlashSuccess(__('Record created.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  PriceItem  $priceItem
     * @return Application|Factory|View
     */
    public function edit(PriceItem $priceItem)
    {
        $currencies = Currency::toSelectBox('iso', 'iso');

        $tours = Tour::toSelectBox('title', 'id');

        return view('admin.price-item.edit', [
            'priceItem' => $priceItem,
            'currencies' => $currencies,
            'tours' => $tours,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PriceItemBasicRequest  $request
     * @param  PriceItem  $priceItem
     * @return mixed
     *
     * @throws GeneralException
     */
    public function update(PriceItemBasicRequest $request, PriceItem $priceItem)
    {
        $priceItem->fill($request->all());
        $priceItem->save();

        return redirect()->route('admin.price-item.index', $priceItem)->withFlashSuccess(__('Record updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PriceItem  $priceItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(PriceItem $priceItem)
    {
        $priceItem->delete();

        return redirect()->route('admin.price-item.index')->withFlashSuccess(__('Record deleted.'));
    }
}
