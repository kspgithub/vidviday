@extends('admin.layout.app')

@section('title', __('Places'))

@section('content')
    {!! breadcrumbs([
  ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
  ['url'=>route('admin.place.index'), 'title'=>__('Places')],
]) !!}


    <div class="d-flex justify-content-between">
        <h1>@lang('Place management')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.place.create')}}" class="btn btn-sm btn-outline-info"><i
                    data-feather="plus"></i> @lang('Create record')</a>
        </div>
    </div>

    {{--    @include('admin.place.includes.list')--}}
    <x-bootstrap.card>
        <x-slot name="body">
            <livewire:places-table/>
        </x-slot>
    </x-bootstrap.card>

@endsection
