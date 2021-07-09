@extends('admin.layout.app')

@section('title', __('New Translation'))

@section('content')
{{--    <div class="mb-2">--}}
{{--        {!! breadcrumbs([--}}
{{--            ['url'=>route('admin.dashboard'), 'title'=>__('Home')],--}}
{{--            ['url'=>route('admin.translation.index'), 'title'=>__('Translations')],--}}
{{--            ['url'=>route('admin.translation.create'), 'title'=>__('New Translation')],--}}
{{--        ]) !!}--}}
{{--    </div>--}}
    <div class="d-flex justify-content-between">
        <h1>{{__('New Translation')}}</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.translation.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>


    <x-bootstrap.card>
        <x-slot name="body">
            <x-forms.post action="{{route('admin.translation.store')}}">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        @include('admin.translation.includes.form')
                        <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                    </div>
                </div>

            </x-forms.post>
        </x-slot>
    </x-bootstrap.card>
@endsection
