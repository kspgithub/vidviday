@extends('admin.layout.app')

@section('title', __('Article management'))

@section("content")

    <div class="d-flex justify-content-between">
        <h1>@lang('Article management')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.article.create')}}" class="btn btn-sm btn-outline-info"><i data-feather="user-plus"></i> @lang('Create article')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <livewire:articles-table />
        </x-slot>
    </x-bootstrap.card>

@endsection
