@extends('admin.layout.app')

@section('title', __('Order') .' #'.$order->order_number.' - '.__('Edit'))

@section("content")

    <div class="d-flex justify-content-between">
        <h1>{{__('Order') .' #'.$order->order_number.' - '.__('Edit')}}</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.order.index')}}" class="btn btn-sm btn-outline-info">
                @lang('Back')
            </a>
        </div>
    </div>

    <livewire:order-form :order="$order"/>

@endsection
