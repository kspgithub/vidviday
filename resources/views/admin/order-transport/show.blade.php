@extends('admin.layout.app')

@section('title', __('Transport Rental') .' #'.$order->id)

@section("content")

    <div class="d-flex justify-content-between">
        <h1>{{__('Transport Rental') .' #'.$order->id}}</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.order-transport.edit', $order)}}" class="btn btn-sm btn-outline-success me-3">
                @lang('Edit')
            </a>
            <a href="{{route('admin.order-transport.index')}}" class="btn btn-sm btn-outline-info">
                @lang('Back')
            </a>
        </div>
    </div>

    <livewire:order-transport-info :order="$order"/>

@endsection
