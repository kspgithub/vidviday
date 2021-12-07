@extends('admin.layout.app')

@section('title', __('Contacts'))

@section('content')


    {!! breadcrumbs([
        ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
        ['url'=>route('admin.contact.edit'), 'title'=>__('Contacts')],
    ]) !!}
    <x-page.edit :update-url="route('admin.contact.update')"
                 :back-url="route('admin.contact.edit')" :edit="true"
                 :title="__('Edit').': '.__('Contacts')"
    >
        @include('admin.contact.includes.form')
    </x-page.edit>


@endsection
