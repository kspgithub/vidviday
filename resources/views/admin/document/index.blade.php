@extends('admin.layout.app')

@section('title', __('Document management'))

@section("content")

    <div class="d-flex justify-content-between">
        <h1>@lang('Document management')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.document.create')}}" class="btn btn-sm btn-outline-info"><i data-feather="user-plus"></i> @lang('Create record')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <livewire:documents-table />
        </x-slot>
    </x-bootstrap.card>

@endsection
