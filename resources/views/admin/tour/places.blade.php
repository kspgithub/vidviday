@extends('admin.layout.app')

@section('title', __('Edit tour') .'-'.__('Places'))



@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Edit tour') - @lang('Places')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.tour.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    @include('admin.tour.includes.edit-tabs')

    <x-forms.patch :action="route('admin.tour.places.update', $tour)">
        <x-bootstrap.card>
            <x-slot name="body">
                <h2 class="mb-5">@lang('Places')</h2>
                <livewire:tour-places :tour="$tour"/>
            </x-slot>
        </x-bootstrap.card>
    </x-forms.patch>


@endsection

