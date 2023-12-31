@extends('admin.layout.app')

@section('title', __('Editing tour')." $tour->title - ".__('Schedule'))

@section('content')
    {!! breadcrumbs([
   ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
   ['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
   ['url'=>route('admin.tour.edit', $tour), 'title'=>$tour->title],
   ['url'=>'#', 'title'=>__('Schedule')],
   ]) !!}
    <div class="d-flex justify-content-between">
        <h1>@lang('Editing tour') "{{$tour->title}}" - @lang('Schedule')</h1>
    </div>
    <div class="row">
        <div class="col-12 col-md-3 col-xl-2">
            @include('admin.tour.includes.edit-tabs')
        </div>
        <div class="col-12 col-md-9 col-xl-10">

            {{--            <livewire:tour-schedules-table :tour="$tour"/>--}}

            @include('admin.tour-schedule.includes.list')
        </div>
    </div>



@endsection
