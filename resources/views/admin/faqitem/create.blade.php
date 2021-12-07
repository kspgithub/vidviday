@extends('admin.layout.app')

@section('title', __('Creating').' '.__('FAQ'))

@section('breadcrumbs')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=> __('Dashboard')],
    ['url'=>route('admin.faqitem.index'), 'title'=> __('FAQ')],
    ['url'=>route('admin.faqitem.index', $section), 'title'=> \App\Models\FaqItem::$sections[$section]],
    ['url'=>route('admin.faqitem.create', $section), 'title'=> __('Creating')],
]) !!}
@endsection

@section('content')

    <x-forms.post :action="route('admin.faqitem.store', $section)" enctype="multipart/form-data">
        <x-bootstrap.card>
            <x-slot name="header">
                <h4>{{__('Creating').' '.__('FAQ')}}</h4>
            </x-slot>
            <x-slot name="body">
                @include('admin.faqitem.includes.form')
            </x-slot>
            <x-slot name="footer">
                <button class="btn btn-primary" type="submit">@lang('Save')</button>
            </x-slot>
        </x-bootstrap.card>
    </x-forms.post>

@endsection
