@extends('admin.layout.app')

@section('title', __('Create Price item'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Create Price item') <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div></h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.price-item.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <x-forms.post :action="route('admin.price-item.store')" enctype="multipart/form-data">
        @include('admin.price-item.includes.form')
        <button class="btn btn-primary" type="submit">@lang('Save')</button>
    </x-forms.post>


@endsection
