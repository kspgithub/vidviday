@extends('admin.layout.app')

@section('title', __('Order Certificates'))

@section("content")

    <div class="d-flex justify-content-between">
        <h1>@lang('Order Certificates')</h1>

        <div class="d-flex align-items-center">

        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <livewire:order-certificates-table/>
        </x-slot>
    </x-bootstrap.card>

@endsection
