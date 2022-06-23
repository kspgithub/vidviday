@extends('admin.layout.app')

@section('title', __('Accommodation Types').' - '.__('Edit'))

@section('content')
    {!! breadcrumbs([
   ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
   ['url'=>route('admin.accommodation-type.index'), 'title'=>__('Accommodation Types')],
   ['url'=>'#', 'title'=>$type->title],
   ]) !!}
    <x-page.edit :update-url="route('admin.accommodation-type.update', $type)"
                 :back-url="route('admin.accommodation-type.index')" :edit="true"
                 :expanded="true"
                 :title="__('Edit').' '.__('Accommodation Type')"
    >
        @include('admin.accommodation-type.includes.form')
    </x-page.edit>

@endsection
