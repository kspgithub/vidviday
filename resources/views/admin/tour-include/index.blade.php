@extends('admin.layout.app')

@section('title', __('Tour Include management'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Tour Include management')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.tour-include.create')}}" class="btn btn-sm btn-outline-info"><i data-feather="plus"></i> @lang('Create record')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <livewire:tour-includes-table />
        </x-slot>
    </x-bootstrap.card>

@endsection
