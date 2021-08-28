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
            <livewire:staffs-table />
            {{-- <table class="table table-responsive table-striped table-sm">
                <thead>
                <tr>
                    <th>@lang('First Name')</th>
                    <th>@lang('Type')</th>
                    <th>@lang('Locale')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($staffs as $staff)
                    <tr>
                        <td>{{$staff->last_name}} {{$staff->first_name}}</td>
                        <td>{!! $staff->types->implode('title', '<br>') !!}</td>
                        <td>{{app()->getLocale()}}</td>
                        <td class="table-action">

                            <x-utils.edit-button :href="route('admin.staff.edit', ['staff'=>$staff])" text=""/>
                            <x-utils.delete-button :href="route('admin.staff.destroy', ['staff'=>$staff])" text=""/>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table> --}}
        </x-slot>
    </x-bootstrap.card>

    {{ $staffs->links() }}

@endsection

