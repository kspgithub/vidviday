@extends('admin.layout.app')

@section('title', __('Партнеры').' - '.__('Редагування'))

@section("content")
    {!! breadcrumbs([
  ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
  ['url'=>route('admin.partner.index'), 'title'=>__('Партнеры')],
  ['url'=>route('admin.partner.edit', $partner), 'title'=>__('Редагування')],
]) !!}

    <x-page.edit :title="__('Редагування').': '.$partner->title"
                 :backUrl="route('admin.partner.index')"
                 :updateUrl="route('admin.partner.update', $partner)"
                 :edit="true"
    >
        @include('admin.partner.includes.form')
    </x-page.edit>

@endsection
