@extends('admin.layout.app')

@section('title', __('Editing tour') .'-'.__('Accommodation'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Tour') "{{$tour->title}}" - @lang('Accommodation')
            <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div>
        </h1>
    </div>

    <div class="row">
        <div class="col-12 col-md-3 col-xl-2">
            @include('admin.tour.includes.edit-tabs')
        </div>
        <div class="col-12 col-md-9 col-xl-10">
            <x-bootstrap.card>
                <x-slot name="body">
                    <livewire:tour-accommodation :tour="$tour"/>
                </x-slot>

            </x-bootstrap.card>


        </div>
    </div>

@endsection
