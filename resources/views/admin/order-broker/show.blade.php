@extends('admin.layout.app')

@section('title', __('Broker Consult') .' #'.$order->id)

@section("content")

    <div class="d-flex justify-content-between">
        <h1>{{__('Broker Consult') .' #'.$order->id}}</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.order-broker.edit', $order)}}" class="btn btn-sm btn-outline-success me-3">
                @lang('Edit')
            </a>
            <a href="{{route('admin.order-broker.index')}}" class="btn btn-sm btn-outline-info">
                @lang('Back')
            </a>
        </div>
    </div>

    <livewire:order-broker-info :order="$order"/>

@endsection
