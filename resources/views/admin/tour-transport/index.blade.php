@extends('admin.layout.app')

@section('title', __('Editing tour') .'-'.__('Transport'))

@section('content')
{!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
['url'=>route('admin.tour.edit', $tour), 'title'=>$tour->title],
['url'=>'#', 'title'=>__('Transport')],
]) !!}
    <div class="d-flex justify-content-between">
        <h1>@lang('Tour') "{{$tour->title}}" - @lang('Transport')
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
                    <livewire:tour-transport :tour="$tour"/>
                </x-slot>

            </x-bootstrap.card>


        </div>
    </div>

@endsection
