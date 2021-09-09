@extends('admin.layout.app')

@section('title', __('Editing tour') .'-'.__('Plan'))



@section('content')
    <h1 class="mb-3">@lang('Editing tour') "{{$tour->title}}" - @lang('Plan')</h1>
    <div class="row">
        <div class="col-12 col-md-3 col-xl-2">
            @include('admin.tour.includes.edit-tabs')
        </div>
        <div class="col-12 col-md-9 col-xl-10">
            <livewire:tour-plan-table :tour="$tour"/>
        </div>
    </div>


@endsection

