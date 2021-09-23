@extends('admin.layout.app')

@section('title', __('Edit blog'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Blog')  -  @lang('Pictures')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.blog.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <x-utils.media-library
                :store-url="route('admin.blog.picture.store', $blog)"
                :destroy-url="route('admin.blog.picture.destroy', [$blog, 0])"
                :update-url="route('admin.blog.picture.update', [$blog, 0])"
                :items="$blog->getMedia('pictures')"
                collection="pictures"
            ></x-utils.media-library>
        </x-slot>


    </x-bootstrap.card>

@endsection
