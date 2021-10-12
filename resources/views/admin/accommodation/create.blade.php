@extends('admin.layout.app')

@section('title', __('Accommodation').' - '.__('Create'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>{{__('Accommodation').' - '.__('Create')}}
            <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div>
        </h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.accommodation.index')}}"
               class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <div x-data="transletable()">
        <x-forms.post :action="route('admin.accommodation.store')" enctype="multipart/form-data" x-ref="form">
            <x-bootstrap.card>
                <x-slot name="body">
                    @include('admin.accommodation.includes.form')

                </x-slot>
                <x-slot name="footer">
                    <button class="btn btn-primary" type="submit" x-on:click.prevent="submit()">@lang('Save')</button>
                </x-slot>
            </x-bootstrap.card>
        </x-forms.post>
    </div>


@endsection
