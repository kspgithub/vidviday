@extends('admin.layout.app')

@section('title', __('Tour').' '.$tour->title.' - '.__('Edit Food'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Tour') "{{$tour->title}}" - @lang('Edit Food') <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div></h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.tour.food.index', $tour)}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <x-forms.patch :action="route('admin.tour.food.update', ['tour'=>$tour, 'food'=>$food])" enctype="multipart/form-data">
        <x-bootstrap.card>
            <x-slot name="body">
                @include('admin.tour-food.includes.form')
            </x-slot>
            <x-slot name="footer">
                <button class="btn btn-primary" type="submit">@lang('Save')</button>
            </x-slot>
        </x-bootstrap.card>
    </x-forms.patch>


@endsection
