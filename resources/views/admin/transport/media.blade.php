@extends('admin.layout.app')

@section('title', __('Edit transport'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('transport') "{{$transport->title}}" - @lang('Media')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.transport.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <x-utils.media-library
                :upload-url="route('admin.transport.media.upload', $transport)"
                :destroy-url="route('admin.transport.media.destroy', [$transport, 0])"
                :items="$transport->getMedia()"
            ></x-utils.media-library>
        </x-slot>
    </x-bootstrap.card>

@endsection
