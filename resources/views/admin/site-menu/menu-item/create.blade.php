@extends('admin.layout.app')

@section('title', __('Create').': '.__('Menu Item'))

@section('content')
    @if(!empty($item->parent))
        {!! breadcrumbs([
           ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
           ['url'=>route('admin.site-menu.index'), 'title'=>__('Site menu')],
           ['url'=>route('admin.site-menu.item.edit', $item->parent), 'title'=>$item->parent->title],
           ['url'=>route('admin.site-menu.item.create', $menu), 'title'=>__('Create')],
       ]) !!}
    @else

        {!! breadcrumbs([
            ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
            ['url'=>route('admin.site-menu.index'), 'title'=>__('Site menu')],
            ['url'=>route('admin.site-menu.item.create', $menu), 'title'=>__('Create')],
        ]) !!}

    @endif
    <x-page.edit :update-url="route('admin.site-menu.item.store', $menu)"
                 :back-url="route('admin.site-menu.index')"
                 :title="__('Create')"
    >
        @include('admin.site-menu.menu-item.form')
    </x-page.edit>

@endsection
