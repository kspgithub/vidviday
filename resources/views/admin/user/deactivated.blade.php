@extends('admin.layout.app')

@section('title', __('Deactivated Users'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Deactivated Users')</h1>

        <div>

        </div>
    </div>

    @include('admin.user.includes.tabs')

    <x-bootstrap.card>
        <x-slot name="body">
            <livewire:users-table status="deactivated" />
        </x-slot>
    </x-bootstrap.card>
@endsection
