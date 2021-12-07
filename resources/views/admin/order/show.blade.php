@extends('admin.layout.app')

@section('title', __('Order') .' #'.$order->order_number)

@section("content")

    <div class="d-flex justify-content-between">
        <h1>{{__('Order') .' #'.$order->order_number}}</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.order.edit', $order)}}" class="btn btn-sm btn-outline-success me-3">
                @lang('Edit')
            </a>
            <a href="{{route('admin.order.index')}}" class="btn btn-sm btn-outline-info">
                @lang('Back')
            </a>
        </div>
    </div>

    <livewire:order-info :order="$order"/>

@endsection
