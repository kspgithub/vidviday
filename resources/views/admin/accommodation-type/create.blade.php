@extends('admin.layout.app')

@section('title', __('Accommodation Type').' - '.__('Create'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>{{__('Accommodation Type').' - '.__('Create')}} <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div></h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.accommodation-type.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <x-forms.post :action="route('admin.accommodation-type.store')" enctype="multipart/form-data">
        <x-bootstrap.card>
            <x-slot name="body">
                @include('admin.accommodation-type.includes.form')

            </x-slot>
            <x-slot name="footer">
                <button class="btn btn-primary" type="submit">@lang('Save')</button>
            </x-slot>
        </x-bootstrap.card>
    </x-forms.post>

@endsection
