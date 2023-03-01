@extends('admin.layout.app')

@section('title', __('Sms Notifications'))

@section('breadcrumbs')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=> __('Dashboard')],
    ['url'=>route('admin.sms-notifications.index'), 'title'=> __('Sms Notifications')],
    ['url'=>route('admin.sms-notifications.edit', $notification->key), 'title'=> $notification->key],
]) !!}
@endsection

@section('content')
    <x-page.edit :update-url="route('admin.sms-notifications.save', $notification->key)"
                 :back-url="route('admin.sms-notifications.index')" :edit="true"
                 :title="__('Edit').' '.__('Email templates')"
    >
        @include('admin.sms-notifications.includes.form')
    </x-page.edit>
@endsection
