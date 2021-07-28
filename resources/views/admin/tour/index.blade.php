@extends('admin.layout.app')

@section('title', __('Tour management'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Tour management')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.tour.create')}}" class="btn btn-sm btn-outline-info"><i data-feather="plus"></i> @lang('Create tour')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <livewire:tours-table />
        </x-slot>
    </x-bootstrap.card>

@endsection
