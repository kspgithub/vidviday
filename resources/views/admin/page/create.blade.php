@extends('admin.layout.app')

@section('title', __('Create page'))

@section('content')
    <x-page.edit :title="__('Create page')"
                 :backUrl="route('admin.page.index')"
                 :updateUrl="route('admin.page.store')"
    >
        @include('admin.page.includes.form')
    </x-page.edit>

@endsection
