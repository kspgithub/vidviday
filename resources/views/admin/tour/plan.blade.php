@extends('admin.layout.app')

@section('title', __('Editing tour') .'-'.__('Plan'))



@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Editing tour') "{{$tour->title}}" - @lang('Plan')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.tour.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-3 col-xl-2">
            @include('admin.tour.includes.edit-tabs')
        </div>
        <div class="col-12 col-md-9 col-xl-10">
            <livewire:tour-plan-table :tour="$tour"/>
        </div>
    </div>


@endsection

