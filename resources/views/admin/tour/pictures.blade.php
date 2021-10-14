@extends('admin.layout.app')

@section('title', __('Editing tour'))

@section('content')
    <h1 class="mb-3">@lang('Editing tour') "{{$tour->title}}" - @lang('Pictures')</h1>
    <div class="row">
        <div class="col-12 col-md-3 col-xl-2">
            @include('admin.tour.includes.edit-tabs')
        </div>
        <div class="col-12 col-md-9 col-xl-10">
            <x-bootstrap.card>
                <x-slot name="body">
                    <h2>@lang('Pictures')</h2>

                    <x-utils.media-library
                        :model="$tour"
                        collection="pictures"
                    ></x-utils.media-library>

                </x-slot>
            </x-bootstrap.card>

        </div>
    </div>

@endsection
