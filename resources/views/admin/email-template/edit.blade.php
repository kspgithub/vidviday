@extends('admin.layout.app')

@section('title', __('Email templates'))

@section('breadcrumbs')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=> __('Dashboard')],
    ['url'=>route('admin.email-templates.index'), 'title'=> __('Email templates')],
    ['url'=>route('admin.email-templates.index'), 'title'=> $template],
]) !!}
@endsection

@section('content')
    <x-page.edit :update-url="route('admin.email-templates.save', Str::replace('\\','-',$template))"
                 :back-url="route('admin.email-templates.index')" :edit="true"
                 :title="__('Edit').' '.__('Email templates')"
    >
        @include('admin.email-template.includes.form')
    </x-page.edit>
@endsection
