@extends('admin.layout.app')

@section('title', __('Edit Tour Subject'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Tour Subject') "{{$tourSubject->title}}" - @lang('Media')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.tour-subjects.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <x-utils.media-library
                :upload-url="route('admin.tour-subjects.media.upload', $tourSubject)"
                :destroy-url="route('admin.tour-subjects.media.destroy', [$tourSubject, 0])"
                :items="$tourSubject->getMedia()"
            ></x-utils.media-library>
        </x-slot>
    </x-bootstrap.card>

@endsection
