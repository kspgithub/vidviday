@extends('admin.layout.app')

@section('title', __('Edit').' '.__('Finance'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>{{ __('Edit').' '.__('Finance')}}</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.finance.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>
    <div x-data="translatable()">
        <x-forms.patch :action="route('admin.finance.update', $model)" enctype="multipart/form-data" x-ref="form">
            <x-bootstrap.card>
                <x-slot name="body">
                    @include('admin.finance.includes.form')

                </x-slot>
                <x-slot name="footer">
                    <button class="btn btn-primary" type="submit"
                            x-on:click.prevent="submit($event)">@lang('Save')</button>
                </x-slot>
            </x-bootstrap.card>
        </x-forms.patch>
    </div>

@endsection
