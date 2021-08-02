@extends('admin.layout.app')

@section('title', __('Create ticket'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Create ticket') <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div></h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.ticket.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <x-forms.post :action="route('admin.ticket.store')" enctype="multipart/form-data">
        @include('admin.ticket.includes.form')
        <button class="btn btn-primary" type="submit">@lang('Next')</button>
    </x-forms.post>


@endsection
