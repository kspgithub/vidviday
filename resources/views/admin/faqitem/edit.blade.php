@extends('admin.layout.app')

@section('title', __('Editing').' '.__('FAQ'))

@section('content')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=> __('Dashboard')],
    ['url'=>route('admin.faqitem.index'), 'title'=> __('FAQ')],
    ['url'=>route('admin.faqitem.index', $section), 'title'=> \App\Models\FaqItem::$sections[$section]],
    ['url'=>'#', 'title'=> __('Editing')],
]) !!}
    <x-page.edit :update-url="route('admin.faqitem.update', ['faqItem'=>$faqitem, 'section'=>$section])"
                 :back-url="route('admin.faqitem.index', $section)" :edit="true"
                 :title="__('Edit').' '.__('FAQ')"
    >
        @include('admin.faqitem.includes.form')
    </x-page.edit>

@endsection
