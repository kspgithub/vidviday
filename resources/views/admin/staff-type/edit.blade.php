@extends('admin.layout.app')

@section('title', __('Edit StaffType'))

@section('content')
<div class="d-flex justify-content-between">
    <h1>@lang('Edit StaffType') <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div></h1>

    <div class="d-flex align-items-center">
        <a href="{{route('admin.staff-type.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
    </div>
</div>
    <x-forms.patch :action="route('admin.staff-type.update', $staffType)" enctype="multipart/form-data">
        <x-bootstrap.card>
            <x-slot name="body">
                @include('admin.staff-type.includes.form')
            </x-slot>
            <x-slot name="footer">
                <button class="btn btn-primary" type="submit">@lang('Save')</button>
            </x-slot>
        </x-bootstrap.card>
    </x-forms.patch>

@endsection
