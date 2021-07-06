@extends('admin.layout.app')

@section('title', __('Edit direction'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('direction') "{{$direction->title}}" - @lang('Media')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.direction.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <x-utils.media-library
                :store-url="route('admin.direction.media.upload', $direction)"
                :destroy-url="route('admin.media.destroy', 0)"
                :update-url="route('admin.media.update', 0)"
                :items="$direction->getMedia()"
            ></x-utils.media-library>
        </x-slot>
    </x-bootstrap.card>

@endsection
