@extends('admin.layout.app')

@section('title', __('Price Item management'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Price Item management')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.price-item.create')}}" class="btn btn-sm btn-outline-info"><i data-feather="plus"></i> @lang('Create record')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <livewire:price-items-table />
        </x-slot>
    </x-bootstrap.card>

@endsection
