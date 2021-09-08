@extends('admin.layout.app')

@section('title', __('Create contact'))

@section('content')

    <x-forms.post :action="route('admin.contact.store')" enctype="multipart/form-data">
        <x-bootstrap.card>
            <x-slot name="body">
                @include('admin.contact.includes.form')
            </x-slot>
            <x-slot name="footer">
                <button class="btn btn-primary" type="submit">@lang('Save')</button>
            </x-slot>
        </x-bootstrap.card>
    </x-forms.post>

@endsection
