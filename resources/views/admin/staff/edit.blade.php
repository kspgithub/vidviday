@extends('admin.layout.app')

@section('title', __('Edit employee'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Edit employee')
            <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div>
        </h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.staff.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>
    <div x-data="translatable()">
        <x-forms.patch :action="route('admin.staff.update', $staff)" x-ref="form" enctype="multipart/form-data">
            <div>
                @include('admin.staff.includes.form')
                <button class="btn btn-primary" type="submit" x-on:click.prevent="submit($event)">@lang('Save')</button>
            </div>
        </x-forms.patch>
    </div>


@endsection
