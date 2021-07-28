@extends('admin.layout.app')

@section('title', __('Edit badge'))

@section('content')

    <x-forms.patch :action="route('admin.badge.update', $badge)" enctype="multipart/form-data">
        <x-bootstrap.card>
            <x-slot name="body">
                @include('admin.badge.includes.form')

            </x-slot>
            <x-slot name="footer">
                <button class="btn btn-primary" type="submit">@lang('Save')</button>
            </x-slot>
        </x-bootstrap.card>
    </x-forms.patch>

@endsection
