@extends('admin.layout.app')

@section('title', 'Створити квиток')

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.ticket.index'), 'title'=>'Квитки'],
['url'=>route('admin.ticket.create'), 'title'=>__('Create')],
]) !!}
    <div class="d-flex justify-content-between">
        <h1>Створити квиток</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.ticket.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>
    <div x-data="translatable()">
        <x-forms.post :action="route('admin.ticket.store')" enctype="multipart/form-data" x-ref="form">
            @include('admin.ticket.includes.form')
            <button class="btn btn-primary" type="submit" x-on:click.prevent="submit($event)">@lang('Save')</button>
        </x-forms.post>
    </div>

@endsection
