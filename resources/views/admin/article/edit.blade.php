@extends('admin.layout.app')

@section('title', __('Edit article'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Edit article') <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div></h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.article.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <x-forms.patch :action="route('admin.article.update', $article)" enctype="multipart/form-data">
        @include('admin.article.includes.edit-tabs')
        @include('admin.article.includes.form')
        <button class="btn btn-primary" type="submit">@lang('Save')</button>
    </x-forms.patch>

@endsection
