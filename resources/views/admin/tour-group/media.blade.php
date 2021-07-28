@extends('admin.layout.app')

@section('title', __('Edit').' '.__('Tour Group'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Tour Group') "{{$tourGroup->title}}" - @lang('Media')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.page.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <x-utils.media-library
                :store-url="route('admin.media.store', ['model_type'=>get_class($tourGroup), 'model_id'=>$tourGroup->id])"
                :destroy-url="route('admin.media.destroy', 0)"
                :update-url="route('admin.media.update', 0)"
                :items="$tourGroup->getMedia()"
            ></x-utils.media-library>
        </x-slot>
    </x-bootstrap.card>

@endsection
