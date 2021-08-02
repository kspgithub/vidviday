@extends('admin.layout.app')

@section('title', __('Create html block'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Create html block') <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div></h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.html-block.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <x-forms.post :action="route('admin.html-block.store')" enctype="multipart/form-data">
        @include('admin.html-block.includes.form')
        <button class="btn btn-primary" type="submit">@lang('Next')</button>
    </x-forms.post>


@endsection
