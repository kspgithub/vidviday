@extends('admin.layout.app')

@section('title', __('Food'))

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1>@lang('Food')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.food.create', ['time_id'=>request('time_id', ''), 'region_id'=>request('region_id', '')])}}"
               class="btn btn-sm btn-outline-info">
                <i data-feather="plus"></i> @lang('Create')
            </a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <livewire:food-table />
        </x-slot>
    </x-bootstrap.card>

@endsection
