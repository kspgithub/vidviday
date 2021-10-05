<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\AccommodationType;
use App\Models\Order;
use App\Models\PaymentType;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        //
        return view('admin.order.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        //
        $order = new Order();
        return view('admin.order.create', ['order'=>$order]);
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
        $order = new Order();
        $order->fill($request->all());
        return redirect()->route('admin.order.index')->withFlashSuccess(__('Record Created'));
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return View
     */
    public function show(Order $order)
    {
        //
        return view('admin.order.show', [ 'order'=>$order ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Order $order
     * @return View
     */
    public function edit(Order $order)
    {
        //
        return view('admin.order.edit', [
            'order'=>$order
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Order $order
     * @return Response
     */
    public function update(Request $request, Order $order)
    {
        //
        $order->fill($request->all());
        return redirect()->route('admin.order.index')->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return Response
     */
    public function destroy(Order $order)
    {
        //
        $order->delete();
        return redirect()->route('admin.order.index')->withFlashSuccess(__('Record Deleted'));
    }
}
