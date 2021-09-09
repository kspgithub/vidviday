@extends('admin.layout.app')

@section('title', __('Editing tour') .' - '.__('Question about the tour'))



@section('content')
    <h1 class="mb-3">@lang('Editing tour') "{{$tour->title}}" - @lang('Question about the tour')</h1>

    <div class="row">
        <div class="col-12 col-md-3 col-xl-2">
            @include('admin.tour.includes.edit-tabs')
        </div>
        <div class="col-12 col-md-9 col-xl-10">
            <x-bootstrap.card>
                <x-slot name="body">
                    <h2 class="mb-5">@lang('Questions')</h2>
                    <livewire:tour-faq-table :tour="$tour"/>
                </x-slot>
            </x-bootstrap.card>
        </div>
    </div>


@endsection

