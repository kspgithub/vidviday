@extends('admin.layout.app')

@section('title', __('Edit event'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Edit event') <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div></h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.event.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <x-forms.patch :action="route('admin.event.update', $event)" enctype="multipart/form-data">
        @include('admin.event.includes.edit-tabs')
        @include('admin.event.includes.form')
        <button class="btn btn-primary" type="submit">@lang('Save')</button>
    </x-forms.patch>

@endsection
