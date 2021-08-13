@extends('admin.layout.app')

@section('title', __('Edit html block'))

@section('content')

    <x-forms.patch :action="route('admin.html-block.update', $htmlBlock)" enctype="multipart/form-data">
        <x-bootstrap.card>
            <x-slot name="body">
                @include('admin.html-block.includes.form')

            </x-slot>
            <x-slot name="footer">
                <button class="btn btn-primary" type="submit">@lang('Save')</button>
            </x-slot>
        </x-bootstrap.card>
    </x-forms.patch>

@endsection
