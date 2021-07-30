@extends('admin.layout.app')

@section('title', __('Edit page'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Page') "{{$page->title}}" - @lang('Media')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.page.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <x-utils.media-library
                :store-url="route('admin.page.media.upload', $page)"
                :items="$page->getMedia()"
            ></x-utils.media-library>
        </x-slot>
    </x-bootstrap.card>

@endsection
