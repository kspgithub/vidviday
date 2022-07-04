@extends('admin.layout.app')

@section('title', __('Testimonials'))

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.testimonial.index'), 'title'=>__('Testimonials')],
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
        <x-forms.patch :action="route('admin.testimonial.update', $testimonial)" x-ref="form" enctype="multipart/form-data">
            <div>
                @include('admin.testimonial.includes.form')

                <button class="btn btn-primary" type="submit" x-on:click.prevent="submit($event)">@lang('Save')</button>
            </div>
        </x-forms.patch>
    </div>


@endsection
