@extends('admin.layout.app')

@section('title', __('Edit news'))

@section('content')

    <div class="d-flex justify-content-between">
        <h1>@lang('Edit news') <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div></h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.news.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    @include('admin.news.includes.edit-tabs')

    <x-bootstrap.card>
        <x-slot name="body">
            <h2>@lang('Pictures')</h2>

            <x-utils.media-library
                :store-url="route('admin.news.picture.store', $news)"
                :destroy-url="route('admin.news.picture.destroy', [$news, 0])"
                :update-url="route('admin.news.picture.update', [$news, 0])"
                :items="$news->getMedia('pictures')"
                collection="pictures"
            ></x-utils.media-library>

        </x-slot>
        <x-slot name="footer">
            <button class="btn btn-primary" type="submit">@lang('Save')</button>
        </x-slot>
    </x-bootstrap.card>

@endsection
