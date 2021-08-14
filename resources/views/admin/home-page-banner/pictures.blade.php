@extends('admin.layout.app')

@section('title', __('Edit home page banner'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Edit home page banner') <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div></h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.home-page-banner.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    @include('admin.home-page-banner.includes.edit-tabs')

    <x-bootstrap.card>
        <x-slot name="body">
            <h2>@lang('Pictures')</h2>

            <x-utils.media-library
                :store-url="route('admin.home-page-banner.picture.store', $homePageBanner)"
                :destroy-url="route('admin.home-page-banner.picture.destroy', [$homePageBanner, 0])"
                :update-url="route('admin.home-page-banner.picture.update', [$homePageBanner, 0])"
                :items="$homePageBanner->getMedia('pictures')"
                collection="pictures"
            ></x-utils.media-library>

        </x-slot>
        <x-slot name="footer">
            <button class="btn btn-primary" type="submit">@lang('Save')</button>
        </x-slot>
    </x-bootstrap.card>

@endsection
