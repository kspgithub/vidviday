<?php

namespace App\Http\Controllers\Admin\Broker;

use App\Http\Controllers\Controller;
use App\Models\OrderBroker;
use Illuminate\Http\Request;

class OrderBrokerController extends Controller
{
    //
    public function index()
    {
        return view('admin.order-broker.index');
    }

    public function show(OrderBroker $orderBroker)
    {
        return view('admin.order-broker.show', ['order'=>$orderBroker]);
    }

    public function edit(OrderBroker $orderBroker)
    {
        return view('admin.order-broker.edit', ['order'=>$orderBroker]);
    }
}
