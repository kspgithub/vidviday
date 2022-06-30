@extends('admin.layout.app')

@section('title', __('Charity'))

@section("content")
    {!! breadcrumbs([
  ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
  ['url'=>route('admin.charity.index'), 'title'=>__('Charity')],
]) !!}
    <div class="d-flex justify-content-between">
        <h1>@lang('Charity')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.charity.create')}}" class="btn btn-sm btn-outline-info"><i
                    data-feather="plus"></i> @lang('Create record')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <livewire:charity-table/>
        </x-slot>
    </x-bootstrap.card>

@endsection
