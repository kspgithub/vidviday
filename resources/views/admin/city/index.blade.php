@extends('admin.layout.app')

@section('title', __('City management'))

@section('content')

    <div class="d-flex justify-content-between">
        <h1>@lang('City management')</h1>

        <div class="d-flex align-items-center">
            @if(current_user()->isMasterAdmin())
                <a href="{{route('admin.city.create')}}" class="btn btn-sm btn-outline-info"><i data-feather="user-plus"></i> @lang('Create city')</a>
            @endif
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">


            <livewire:cities-table />

        </x-slot>
    </x-bootstrap.card>


@endsection


