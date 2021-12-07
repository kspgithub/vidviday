@extends('admin.layout.app')

@section('title', __('Create employee'))

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.staff.index'), 'title'=>__('Staff')],
['url'=>route('admin.staff.create'), 'title'=>__('Create')],
]) !!}
    <div class="d-flex justify-content-between">
        <h1>@lang('Create employee')
            <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div>
        </h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.staff.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>
    <div x-data="translatable()">
        <x-forms.post :action="route('admin.staff.store')" enctype="multipart/form-data" x-ref="form">
            @include('admin.staff.includes.form')
            <button class="btn btn-primary" type="submit" x-on:click.prevent="submit($event)">@lang('Save')</button>
        </x-forms.post>
    </div>

@endsection
