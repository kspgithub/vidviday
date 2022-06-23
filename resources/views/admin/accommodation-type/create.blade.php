@extends('admin.layout.app')

@section('title', __('Accommodation Types').' - '.__('Create'))

@section('content')
    {!! breadcrumbs([
 ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
 ['url'=>route('admin.accommodation-type.index'), 'title'=>__('Accommodation Types')],
 ['url'=>'#', 'title'=>__('Create')],
 ]) !!}
    <x-page.edit :update-url="route('admin.accommodation-type.store')"
                 :back-url="route('admin.accommodation-type.index')"
                 :expanded="true"
                 :title="__('Create').' '.__('Accommodation Type')"
    >
        @include('admin.accommodation-type.includes.form')
    </x-page.edit>

@endsection
