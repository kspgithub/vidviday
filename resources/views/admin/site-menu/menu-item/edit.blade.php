@extends('admin.layout.app')

@section('title', __('Edit').': '.$item->title)

@section('content')
    @if(!empty($item->parent))
        {!! breadcrumbs([
           ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
           ['url'=>route('admin.site-menu.index'), 'title'=>__('Site menu')],
           ['url'=>route('admin.site-menu.item.edit', $item->parent), 'title'=>$item->parent->title],
           ['url'=>route('admin.site-menu.item.edit', $item), 'title'=>$item->title],
       ]) !!}
    @else
        
        {!! breadcrumbs([
            ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
            ['url'=>route('admin.site-menu.index'), 'title'=>__('Site menu')],
            ['url'=>route('admin.site-menu.item.edit', $item), 'title'=>$item->title],
        ]) !!}

    @endif
    <x-page.edit :update-url="route('admin.site-menu.item.update', $item)"
                 :back-url="route('admin.site-menu.index')" :edit="true"
                 :title="__('Edit').': '.$item->title"
    >
        <div x-data="menuItemEditor()">
            @include('admin.site-menu.menu-item.form')
        </div>
    </x-page.edit>

@endsection
