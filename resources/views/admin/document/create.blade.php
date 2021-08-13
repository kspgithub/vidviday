@extends('admin.layout.app')

@section('title', __('Create Document'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Create document') <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div></h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.document.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <x-forms.post :action="route('admin.document.store')" enctype="multipart/form-data">
        @include('admin.document.includes.form')
        <button class="btn btn-primary" type="submit">@lang('Save')</button>
    </x-forms.post>


@endsection
