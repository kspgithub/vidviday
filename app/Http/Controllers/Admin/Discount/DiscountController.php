<?php

namespace App\Http\Controllers\Admin\Discount;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Discount\DiscountBasicRequest;
use App\Models\Currency;
use App\Models\Discount;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DiscountController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.discount.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $discount = new Discount();

        $discount->currency = 'UAH';

        $currencies = Currency::toSelectBox('iso', 'iso');




        return view('admin.discount.create', [
            'discount'=> $discount,
            'currencies'=> $currencies,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DiscountBasicRequest $request
     *
     * @return mixed
     */
    public function store(DiscountBasicRequest $request)
    {
        $discount = new Discount();

        $discount->fill($request->all());
        $discount->save();

        return redirect()->route('admin.discount.index', ['discount'=> $discount])
            ->withFlashSuccess(__('Discount created.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Discount $discount
     *
     * @return Application|Factory|View
     */
    public function edit(Discount $discount)
    {

        $currencies = Currency::toSelectBox('iso', 'iso');

        return view('admin.discount.edit', [
            'discount'=> $discount,
            'currencies'=>$currencies,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DiscountBasicRequest $request
     *
     * @param Discount $discount
     *
     * @return mixed
     *
     * @throws GeneralException
     */
    public function update(DiscountBasicRequest $request, Discount $discount)
    {
        $discount->fill($request->all());
        $discount->save();

        return redirect()->route('admin.discount.index', $discount)->withFlashSuccess(__('Record updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Discount $discount
     *
     * @return mixed
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();

        return redirect()->route('admin.discount.index')->withFlashSuccess(__('Record deleted.'));
    }




}
