@extends('admin.layout.app')

@section('title', __('Edit place'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Edit place')
            <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div>
        </h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.place.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>
    <div x-data="transletable()">
        <x-forms.patch :action="route('admin.place.update', $place)" enctype="multipart/form-data" x-ref="form">
            @include('admin.place.includes.form')
            <button class="btn btn-primary" type="submit" x-on:click.prevent="submit()">@lang('Save')</button>
        </x-forms.patch>
    </div>
@endsection
