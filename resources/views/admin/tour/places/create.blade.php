@extends('admin.layout.app')

@section('title', __('Editing tour') .'-'.__('Places').' - '.__('Create'))

@section('content')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
    ['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
    ['url'=>route('admin.tour.edit', $tour), 'title'=>$tour->title],
    ['url'=>route('admin.tour.places.index', $tour), 'title'=>__('Місця посадки')],
    ['url'=>route('admin.tour.places.create', $tour), 'title'=>__('Create')],
    ]) !!}
    <div class="row">
        <div class="col-12 col-md-3 col-xl-2">
            @include('admin.tour.includes.edit-tabs')
        </div>
        <div class="col-12 col-md-9 col-xl-10">
            <x-bootstrap.card>
                <x-slot name="body">
                    <x-page.edit :title="__('Create')"
                                 :backUrl="route('admin.tour.places.index', $tour)"
                                 :updateUrl="route('admin.tour.places.store', $tour)"
                                 :expanded="true"
                    >

                        @include('admin.tour.places.form')
                    </x-page.edit>

                </x-slot>
            </x-bootstrap.card>


        </div>
    </div>


@endsection
