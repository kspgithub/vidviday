@extends('admin.layout.app')

@section('title', __('Edit home page banner'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Edit home page banner') <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div></h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.home-page-banner.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <x-forms.patch :action="route('admin.home-page-banner.update', $homePageBanner)" enctype="multipart/form-data">
        @include('admin.home-page-banner.includes.edit-tabs')
        @include('admin.home-page-banner.includes.form')
        <button class="btn btn-primary" type="submit">@lang('Save')</button>
    </x-forms.patch>

@endsection
