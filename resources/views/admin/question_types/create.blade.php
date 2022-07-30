@extends('admin.layout.app')

@section('title', __('Question Types'))

@section('content')
    <x-page.edit :update-url="route('admin.question_types.store')"
                 :back-url="route('admin.question_types.index')"
                 :title="__('Creating').' '.__('Question Type')"
    >
        @include('admin.question_types.includes.form')
    </x-page.edit>
@endsection

