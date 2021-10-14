@extends('admin.layout.app')

@section('title', __('Create page'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Create page') <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div></h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.page.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>
    <div x-data="translatable()">
        <x-forms.post :action="route('admin.page.store')" enctype="multipart/form-data" x-ref="form">
            <x-bootstrap.card>
                <x-slot name="body">
                    @include('admin.page.includes.form')
                </x-slot>
                <x-slot name="footer">
                    <button class="btn btn-primary" type="submit"
                            x-on:click.prevent="submit($event)">@lang('Save')</button>
                </x-slot>
            </x-bootstrap.card>
        </x-forms.post>
    </div>

@endsection
