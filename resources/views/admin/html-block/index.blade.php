@extends('admin.layout.app')

@section('title', __('Html Block management'))

@section("content")

    <div class="d-flex justify-content-between">
        <h1>@lang('Html Block management')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.html-block.create')}}" class="btn btn-sm btn-outline-info"><i data-feather="user-plus"></i> @lang('Create ticket')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <livewire:html-blocks-table />
        </x-slot>
    </x-bootstrap.card>

@endsection
