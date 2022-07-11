@extends('admin.layout.app')

@section('title', __('Creating').' '.__('FAQ'))

@section('breadcrumbs')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=> __('Dashboard')],
    ['url'=>route('admin.faqitem.index'), 'title'=> __('FAQ')],
    ['url'=>route('admin.faqitem.index', $section), 'title'=> \App\Models\FaqItem::$sections[$section]],
    ['url'=>route('admin.faqitem.create', $section), 'title'=> __('Creating')],
]) !!}
@endsection

@section('content')

    <x-page.edit :update-url="route('admin.faqitem.store', $section)"
                 :back-url="route('admin.faqitem.index', $section)"
                 :title="__('Creating').' '.__('FAQ')"
    >
        @include('admin.faqitem.includes.form')
    </x-page.edit>

@endsection
