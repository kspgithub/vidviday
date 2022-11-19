@extends('admin.layout.app')

@section('title', __('Broker Consult'))

@section("content")

    <div class="d-flex justify-content-between">
        <h1>{{__('Broker Consult')}}</h1>

        <div class="d-flex align-items-center">

        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <livewire:orders-broker-table/>
        </x-slot>
    </x-bootstrap.card>

@endsection
