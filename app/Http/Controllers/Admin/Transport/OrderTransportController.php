<?php

namespace App\Http\Controllers\Admin\Transport;

use App\Http\Controllers\Controller;
use App\Models\OrderTransport;

class OrderTransportController extends Controller
{
    //
    public function index()
    {
        return view('admin.order-transport.index');
    }

    public function show(OrderTransport $orderTransport)
    {
        return view('admin.order-transport.show', ['order' => $orderTransport]);
    }

    public function edit(OrderTransport $orderTransport)
    {
        return view('admin.order-transport.edit', ['order' => $orderTransport]);
    }
}
