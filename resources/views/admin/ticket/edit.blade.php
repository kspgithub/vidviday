@extends('admin.layout.app')

@section('title', __('Edit ticket'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Edit ticket')
            <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div>
        </h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.ticket.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>
    <div x-data="translatable()">
        <x-forms.patch :action="route('admin.ticket.update', $ticket)" enctype="multipart/form-data" x-ref="form">
            @include('admin.ticket.includes.form')
            <button class="btn btn-primary" type="submit" x-on:click.prevent="submit()">@lang('Save')</button>
        </x-forms.patch>
    </div>
@endsection
