@extends('admin.layout.app')

@section('title', __('Deleted Users'))


@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Deleted Users')</h1>

        <div>

        </div>
    </div>

    @include('admin.user.includes.tabs')

    <x-bootstrap.card>
        <x-slot name="body">
            <livewire:users-table status="deleted" />
        </x-slot>
    </x-bootstrap.card>
@endsection
