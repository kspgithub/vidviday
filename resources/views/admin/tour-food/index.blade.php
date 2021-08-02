@extends('admin.layout.app')

@section('title', __('Tour').' '.$tour->title.'-'.__('Food'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Tour') "{{$tour->title}}" - @lang('Food')</h1>
        <div class="d-flex align-items-center">
            <a href="{{route('admin.tour.food.create', $tour)}}" class="btn btn-sm btn-outline-info"><i data-feather="plus"></i> @lang('Create')</a>
        </div>
    </div>
    <x-bootstrap.card>
        <x-slot name="body">
            <livewire:tour-food-table :tour="$tour" />
        </x-slot>
    </x-bootstrap.card>

@endsection
