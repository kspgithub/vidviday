@extends('admin.layout.app')

@section('title', __('News'))

@section("content")
    {!! breadcrumbs([
  ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
  ['url'=>route('admin.news.index'), 'title'=>__('News')],
]) !!}
    <div class="d-flex justify-content-between">
        <h1>@lang('News')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.news.create')}}" class="btn btn-sm btn-outline-info"><i
                    data-feather="plus"></i> @lang('Create record')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <livewire:news-table/>
        </x-slot>
    </x-bootstrap.card>

@endsection
