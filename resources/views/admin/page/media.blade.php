@extends('admin.layout.app')

@section('title', __('Edit page'))

@section('content')
    {!! breadcrumbs([
       ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
       ['url'=>route('admin.page.index'), 'title'=>__('Site pages')],
       ['url'=>route('admin.page.edit', $page), 'title'=>$page->title],
       ['url'=>route('admin.page.media.index', $page), 'title'=>__('Media')],
   ]) !!}

    <div class="d-flex justify-content-between">
        <h1>@lang('Page') "{{$page->title}}" - @lang('Media')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.page.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <x-utils.media-library
                :model="$page"
            ></x-utils.media-library>
        </x-slot>
    </x-bootstrap.card>

@endsection
