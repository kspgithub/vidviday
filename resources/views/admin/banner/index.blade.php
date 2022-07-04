@extends('admin.layout.app')

@section('title', __('Banners'))

@section('content')
    {!! breadcrumbs([
        ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
        ['url'=>route('admin.banner.index'), 'title'=>__('Banners')],
    ]) !!}

    <div class="d-flex justify-content-between">
        <h1>@lang('Banners') </h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.banner.create')}}" class="btn btn-sm btn-outline-info"><i
                    data-feather="plus"></i> @lang('Create record')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <livewire:banners-table />

        </x-slot>
    </x-bootstrap.card>

    {{$banners->links()}}
@endsection
