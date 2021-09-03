@extends('admin.layout.app')

@section('title', __('Staff'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Staff')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.staff.create')}}" class="btn btn-sm btn-outline-info"><i
                    data-feather="plus"></i> @lang('Create')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <livewire:staffs-table/>
        </x-slot>
    </x-bootstrap.card>



@endsection

