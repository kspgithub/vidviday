@extends('admin.layout.app')

@section('title', __('Testimonials'))

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.testimonial.resume'), 'title'=>__('Resume')],
['url'=>route('admin.testimonial.edit', $testimonial), 'title'=>__('Edit')],
]) !!}
    <div class="d-flex justify-content-between">
        <h1>@lang('Edit testimonial')
            <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div>
        </h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.testimonial.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>
    <div x-data="translatable()">
        <x-forms.patch :action="route('admin.testimonial.resume.update', $testimonial)" x-ref="form" enctype="multipart/form-data">
            <div>
                @include('admin.testimonial.includes.resume')
            </div>
        </x-forms.patch>
    </div>


@endsection
