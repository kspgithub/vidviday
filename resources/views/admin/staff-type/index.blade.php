@extends('admin.layout.app')

@section('title', __('StaffType management'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('StaffType management')</h1>

        <div class="d-flex align-items-center">
                <a href="{{route('admin.staff-type.create')}}" class="btn btn-sm btn-outline-info"><i data-feather="plus"></i> @lang('Create staff')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <table class="table table-responsive table-striped table-sm">
                <thead>
                <tr>
                    <th>@lang('title')</th>
                    <th>@lang('Locale')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($staffTypes as $staffType)
                    <tr>
                        <td>{{$staffType->title}}</td>
                        <td>{{app()->getLocale()}}</td>
                        <td class="table-action">
                            <x-utils.edit-button :href="route('admin.staff-type.edit', ['staff_type'=>$staffType])" text="" />
                            <x-utils.delete-button :href="route('admin.staff-type.destroy', ['staff_type'=>$staffType])" text="" />
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>
@endsection

