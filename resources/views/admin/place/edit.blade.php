@extends('admin.layout.app')

@section('title', __('Edit place'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Edit place') <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div></h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.place.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <x-forms.patch :action="route('admin.place.update', $place)" enctype="multipart/form-data">
        @include('admin.place.includes.form')
        <button class="btn btn-primary" type="submit">@lang('Save')</button>
    </x-forms.patch>

@endsection
