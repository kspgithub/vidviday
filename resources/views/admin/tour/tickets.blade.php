@extends('admin.layout.app')

@section('title', __('Editing tour') .'-'.__('Tickets'))



@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Editing tour') "{{$tour->title}}" - @lang('Tickets')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.tour.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-3 col-xl-2">
            @include('admin.tour.includes.edit-tabs')
        </div>
        <div class="col-12 col-md-9 col-xl-10">
            <x-bootstrap.card>
                <x-slot name="body">
                    <h2 class="mb-5">@lang('Tickets')</h2>
                    <livewire:tour-tickets :tour="$tour"/>
                </x-slot>
            </x-bootstrap.card>

        </div>
    </div>


@endsection

