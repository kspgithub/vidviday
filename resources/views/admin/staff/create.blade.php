@extends('admin.layout.app')

@section('title', __('Create staff'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Create staff')
            <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div>
        </h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.staff.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <x-forms.post :action="route('admin.staff.store')" enctype="multipart/form-data">
        @include('admin.staff.includes.form')
        <button class="btn btn-primary" type="submit">@lang('Save')</button>

    </x-forms.post>

@endsection
