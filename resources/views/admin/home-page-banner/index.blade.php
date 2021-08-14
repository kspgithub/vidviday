@extends('admin.layout.app')

@section('title', __('Home page banner management'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Home page banner management')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.home-page-banner.create')}}" class="btn btn-sm btn-outline-info"><i data-feather="plus"></i> @lang('Create record')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <livewire:home-page-banners-table />
        </x-slot>
    </x-bootstrap.card>

@endsection
