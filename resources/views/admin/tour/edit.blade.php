@extends('admin.layout.app')

@section('title', __('Editing tour'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Editing tour')
            <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div>
        </h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.tour.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <x-forms.patch :action="route('admin.tour.update', $tour)" enctype="multipart/form-data">
        <div class="row">
            <div class="col-12 col-md-3 col-xl-2">
                @include('admin.tour.includes.edit-tabs')
            </div>
            <div class="col-12 col-md-9 col-xl-10">
                @include('admin.tour.includes.form')
                <button class="btn btn-primary" type="submit">@lang('Save')</button>
            </div>
        </div>


    </x-forms.patch>

@endsection
