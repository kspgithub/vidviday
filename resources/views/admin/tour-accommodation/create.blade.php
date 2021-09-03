@extends('admin.layout.app')

@section('title', __('Tour').' '.$tour->title.' - '.__('Create Accommodation'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Tour') "{{$tour->title}}" - @lang('Create Accommodation')
            <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div>
        </h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.tour.accomm.index', $tour)}}"
               class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-3 col-xl-2">
            @include('admin.tour.includes.edit-tabs')
        </div>
        <div class="col-12 col-md-9 col-xl-10">


            <x-forms.post :action="route('admin.tour.accomm.store', $tour)" enctype="multipart/form-data">
                <x-bootstrap.card>
                    <x-slot name="body">
                        @include('admin.tour-accommodation.includes.form')
                    </x-slot>
                    <x-slot name="footer">
                        <button class="btn btn-primary" type="submit">@lang('Save')</button>
                    </x-slot>
                </x-bootstrap.card>
            </x-forms.post>


        </div>
    </div>


@endsection
