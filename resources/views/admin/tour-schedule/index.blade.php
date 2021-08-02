@extends('admin.layout.app')

@section('title', __('Tour management').'-'.__('Schedule'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Tour management') - @lang('Schedule')</h1>
    </div>

    <livewire:tour-schedules-table :tour="$tour" />

@endsection
