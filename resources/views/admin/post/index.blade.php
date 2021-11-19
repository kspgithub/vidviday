@extends('admin.layout.app')

@section('title', __('Blog'))

@section("content")
    {!! breadcrumbs([
  ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
  ['url'=>route('admin.post.index'), 'title'=>__('Blog')],
]) !!}
    <div class="d-flex justify-content-between">
        <h1>@lang('Blog')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.post.create')}}" class="btn btn-sm btn-outline-info"><i
                    data-feather="plus"></i> @lang('Create record')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <livewire:posts-table/>
        </x-slot>
    </x-bootstrap.card>

@endsection
