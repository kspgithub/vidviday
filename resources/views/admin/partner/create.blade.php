@extends('admin.layout.app')

@section('title', __('Партнеры').' - '.__('Створення'))

@section("content")
    {!! breadcrumbs([
  ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
  ['url'=>route('admin.partner.index'), 'title'=>__('Партнеры')],
  ['url'=>route('admin.partner.create'), 'title'=>__('Створення')],
]) !!}

    <x-page.edit :title="__('Новий партнер')"
                 :backUrl="route('admin.partner.index')"
                 :updateUrl="route('admin.partner.store')"
    >
        @include('admin.partner.includes.form')
    </x-page.edit>

@endsection
