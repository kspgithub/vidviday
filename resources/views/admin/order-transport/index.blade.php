@extends('admin.layout.app')

@section('title', __('Transport Rental'))

@section("content")

    <div class="d-flex justify-content-between">
        <h1>{{__('Transport Rental')}}</h1>

        <div class="d-flex align-items-center">

        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <livewire:orders-transport-table/>
        </x-slot>
    </x-bootstrap.card>

@endsection
