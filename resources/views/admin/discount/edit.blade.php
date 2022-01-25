@extends('admin.layout.app')

@section('title', __('Edit discount'))

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.discount.index'), 'title'=>__('Discounts')],
['url'=>route('admin.discount.edit', $discount), 'title'=>__('Edit')],
]) !!}
    <div class="d-flex justify-content-between">
        <h1>@lang('Edit discount')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.discount.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>
    <div x-data="translatable()">
        <x-forms.patch :action="route('admin.discount.update', $discount)" enctype="multipart/form-data" x-ref="form">
            @include('admin.discount.includes.form')
            <button class="btn btn-primary" type="submit" x-on:click.prevent="submit($event)">@lang('Save')</button>
        </x-forms.patch>
    </div>
@endsection
