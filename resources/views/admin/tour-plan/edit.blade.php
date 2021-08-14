@extends('admin.layout.app')

@section('title', __('Edit Tour plan'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Edit Tour plan') <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div></h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.tour-plan.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <x-forms.patch :action="route('admin.tour-plan.update', $tourPlan)" enctype="multipart/form-data">
        @include('admin.tour-plan.includes.form')
        <button class="btn btn-primary" type="submit">@lang('Save')</button>
    </x-forms.patch>

@endsection
