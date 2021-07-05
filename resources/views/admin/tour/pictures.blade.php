@extends('admin.layout.app')

@section('title', __('Edit tour'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Edit tour') <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div></h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.tour.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    @include('admin.tour.includes.edit-tabs')

    <x-bootstrap.card>
        <x-slot name="body">
            <h2>@lang('Pictures')</h2>

            <x-utils.media-library
                :store-url="route('admin.tour.picture.store', $tour)"
                :destroy-url="route('admin.tour.picture.destroy', [$tour, 0])"
                :update-url="route('admin.tour.picture.update', [$tour, 0])"
                :items="$tour->getMedia('pictures')"
                collection="pictures"
            ></x-utils.media-library>

        </x-slot>
        <x-slot name="footer">
            <button class="btn btn-primary" type="submit">@lang('Save')</button>
        </x-slot>
    </x-bootstrap.card>

@endsection
