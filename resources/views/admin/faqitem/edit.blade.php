@extends('admin.layout.app')

@section('title', __('Editing').' '.__('FAQ'))

@section('breadcrumbs')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=> __('Dashboard')],
    ['url'=>route('admin.faqitem.index'), 'title'=> __('FAQ')],
    ['url'=>route('admin.faqitem.index', $section), 'title'=> \App\Models\FaqItem::$sections[$section]],
    ['url'=>'#', 'title'=> __('Editing')],
]) !!}
@endsection

@section('content')

    <x-forms.patch :action="route('admin.faqitem.update', ['faqItem'=>$faqitem, 'section'=>$section])" enctype="multipart/form-data">
        <x-bootstrap.card>
            <x-slot name="header">
                <h4>{{__('Editing').' '.__('FAQ')}}</h4>
            </x-slot>
            <x-slot name="body">
                @include('admin.faqitem.includes.form')
            </x-slot>
            <x-slot name="footer">
                <button class="btn btn-primary" type="submit">@lang('Save')</button>
            </x-slot>
        </x-bootstrap.card>
    </x-forms.patch>
@endsection
