@extends('admin.layout.app')

@section('title', __('Tour').' '.$tour->title.'-'.__('Food'))

@section('content')
    {!! breadcrumbs([
   ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
   ['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
   ['url'=>route('admin.tour.edit', $tour), 'title'=>$tour->title],
   ['url'=>'#', 'title'=>__('Food')],
   ]) !!}
    <div class="d-flex justify-content-between">
        <h1>@lang('Tour') "{{$tour->title}}" - @lang('Food')</h1>
        <div class="d-flex align-items-center">

        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-3 col-xl-2">
            @include('admin.tour.includes.edit-tabs')
        </div>
        <div class="col-12 col-md-9 col-xl-10">
            <livewire:tour-food-table :tour="$tour"/>

        </div>
    </div>


@endsection
