@extends('admin.layout.app')

@section('title', __('Accommodations'))

@section("content")

    <div class="d-flex justify-content-between">
        <h1>@lang('Accommodations')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.accommodation.create')}}" class="btn btn-sm btn-outline-info"><i
                    data-feather="plus"></i> @lang('Create')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <livewire:accommodations-table/>
        </x-slot>
    </x-bootstrap.card>

@endsection
