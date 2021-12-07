@extends('admin.layout.app')

@section('title', __('Events'))

@section('content')
    {!! breadcrumbs([
       ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
       ['url'=>route('admin.event.index'), 'title'=>__('Events')],
   ]) !!}

    <div class="d-flex justify-content-between">
        <h1>@lang('Events')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.event.create')}}" class="btn btn-sm btn-outline-info"><i
                    data-feather="plus"></i> @lang('Create event')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <livewire:events-table/>
        </x-slot>
    </x-bootstrap.card>

@endsection
