@extends('admin.layout.app')

@section('title', __('Create tour'))

@section('content')
    {!! breadcrumbs([
     ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
     ['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
     ['url'=>route('admin.tour.create'), 'title'=>__('Create')],
 ]) !!}
    <div class="d-flex justify-content-between">
        <h1>@lang('Create tour')
            <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div>
        </h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.tour.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>
    <div
        x-data="translatable({
            expanded:false,
            share: { plan: { text: {{json_encode($tour->plan->getTranslations('text'))}} },
            locales: {{json_encode($tour->locales)}}
            }
        })">
        <x-forms.post :action="route('admin.tour.store')" enctype="multipart/form-data" x-ref="form">
            @include('admin.tour.includes.form')
            <button class="btn btn-primary" type="submit" x-on:click.prevent="submit($event)">@lang('Save')</button>
        </x-forms.post>
    </div>

@endsection
