@extends('admin.layout.app')

@section('title', __('Editing tour'))

@section('content')
    <h1 class="mb-3">@lang('Editing tour') "{{$tour->title}}" - @lang('Basic information')</h1>

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
