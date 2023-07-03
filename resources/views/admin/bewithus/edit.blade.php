@extends('admin.layout.app')

@section('title', __('BeWithUs'))

@section('content')
    {!! breadcrumbs([
        ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
        ['url'=>route('admin.bewithus.edit'), 'title'=>__('BeWithUs')],
    ]) !!}
    <x-page.edit
                :back-url="route('admin.bewithus.edit')" :edit="true"
                :title="__('Edit').': '.__('BeWithUs')"
    >
        @include('admin.bewithus.includes.form')
    </x-page.edit>
@endsection
