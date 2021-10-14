@extends('admin.layout.app')

@section('title', __('Accommodation').' - '.__('Edit'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>{{__('Accommodation').' - '.__('Edit')}}
            <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div>
        </h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.accommodation.index')}}"
               class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <div x-data="translatable()">
        <x-forms.patch :action="route('admin.accommodation.update', $accommodation)" enctype="multipart/form-data">
            <x-bootstrap.card>
                <x-slot name="body">
                    @include('admin.accommodation.includes.form')
                </x-slot>
                <x-slot name="footer">
                    <button class="btn btn-primary" type="submit" x-on:click.prevent="submit()">@lang('Save')</button>
                </x-slot>
            </x-bootstrap.card>
        </x-forms.patch>
    </div>

@endsection
