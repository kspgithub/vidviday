@extends('admin.layout.app')

@section('title', __('Wrong requests'))

@section('content')
    {!! breadcrumbs([
        ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
        ['url'=>route('admin.wrong_requests.index'), 'title'=>__('Wrong requests')],
    ]) !!}

    <div class="d-flex justify-content-between">
        <h1>@lang('Wrong requests') </h1>

        <div class="d-flex align-items-center">

        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <livewire:wrong-requests-table />
        </x-slot>
    </x-bootstrap.card>

@endsection
