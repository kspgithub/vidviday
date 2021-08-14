@extends('admin.layout.app')

@section('title', __('Include type management'))

@section("content")

    <div class="d-flex justify-content-between">
        <h1>@lang('Include type management')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.include-type.create')}}" class="btn btn-sm btn-outline-info"><i data-feather="user-plus"></i> @lang('Create record')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <livewire:include-types-table />
        </x-slot>
    </x-bootstrap.card>

@endsection
