@extends('admin.layout.app')

@section('title', __('Create Tour Subject'))

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
['url'=>route('admin.tour-subjects.index'), 'title'=>__('Subjects')],
['url'=>'#', 'title'=>__('Create')],
]) !!}

    <x-page.edit :update-url="route('admin.tour-subjects.store')"
                 :back-url="route('admin.tour-subjects.index')"
                 :title="__('Create').' '.__('Tour Subject')"
    >
        @include('admin.tour_subjects.includes.form')
    </x-page.edit>


    <div class="d-flex justify-content-between">
        <h1>@lang('Create Tour Subject')
            <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div>
        </h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.tour-subjects.index')}}"
               class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <x-forms.post :action="route('admin.tour-subjects.store')" enctype="multipart/form-data">
        <x-bootstrap.card>
            <x-slot name="body">
                @include('admin.tour_subjects.includes.form')
            </x-slot>
            <x-slot name="footer">
                <button class="btn btn-primary" type="submit">@lang('Save')</button>
            </x-slot>
        </x-bootstrap.card>
    </x-forms.post>


@endsection
