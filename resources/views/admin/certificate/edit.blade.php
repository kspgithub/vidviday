@extends('admin.layout.app')

@section('title', __('Order Certificate') .' #'.$certificate->order_number.' - '.__('Edit'))

@section("content")


    <div class="d-flex justify-content-between">
        <h1>{{__('Order Certificate') .' #'.$certificate->order_number.' - '.__('Edit')}}</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.certificate.index')}}" class="btn btn-sm btn-outline-info">
                @lang('Back')
            </a>
        </div>
    </div>

    <x-forms.patch :action="route('admin.certificate.update', $certificate)" enctype="multipart/form-data">
        <x-bootstrap.card>
            <x-slot name="body">
                @include('admin.certificate.includes.form')

            </x-slot>
            <x-slot name="footer">
                <button class="btn btn-primary" type="submit">@lang('Save')</button>
            </x-slot>
        </x-bootstrap.card>
    </x-forms.patch>


@endsection
