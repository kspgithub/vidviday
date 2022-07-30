@extends('admin.layout.app')

@section('title', __('Question Types'))

@section('content')
    <x-page.edit :update-url="route('admin.question_types.update', $questionType)"
                 :back-url="route('admin.question_types.index')"
                 :title="__('Editing').' '.__('Question Type')"
                 :edit="true"
    >
        @include('admin.question_types.includes.form')
    </x-page.edit>
@endsection

