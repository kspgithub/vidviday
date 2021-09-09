@extends('admin.layout.app')

@section('title', __('Documents'))

@section("content")

    <div class="d-flex justify-content-between">
        <h1>@lang('Documents')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.document.create')}}" class="btn btn-sm btn-outline-info"><i
                    data-feather="plus"></i> @lang('Create')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <livewire:documents-table/>
        </x-slot>
    </x-bootstrap.card>

@endsection
