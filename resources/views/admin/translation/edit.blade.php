@extends('admin.layout.app')

@section('title', $line->key.' - Редактирование')

@section('content')
    <div class="mb-2">
        {!! breadcrumbs([
            ['url'=>route('admin.dashboard'), 'title'=>__('Home')],
            ['url'=>route('admin.translation.index'), 'title'=>__('Translations')],
            ['url'=>route('admin.translation.edit', $line), 'title'=>__('Edit')],
        ]) !!}
    </div>
    <div class="d-flex justify-content-between">
        <h1>{{$line->key}} - Редактирование</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.translation.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>


    <x-bootstrap.card>
        <x-slot name="body">
            <x-forms.patch action="{{route('admin.translation.update', $line)}}">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        @include('admin.translation.includes.form')
                        <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                    </div>
                </div>

            </x-forms.patch>
        </x-slot>
    </x-bootstrap.card>
@endsection
