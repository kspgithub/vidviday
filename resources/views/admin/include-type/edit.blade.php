@extends('admin.layout.app')

@section('title', __('Edit include type'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Edit include type') <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div></h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.include-type.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <x-forms.patch :action="route('admin.include-type.update', $includeType)" enctype="multipart/form-data">
        @include('admin.include-type.includes.edit-tabs')
        @include('admin.include-type.includes.form')
        <button class="btn btn-primary" type="submit">@lang('Save')</button>
    </x-forms.patch>

@endsection
