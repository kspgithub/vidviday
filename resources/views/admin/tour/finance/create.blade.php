@extends('admin.layout.app')

@section('title', __('Editing tour') .'-'.__('Finance').' - '.__('Create'))

@section('content')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
    ['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
    ['url'=>route('admin.tour.edit', $tour), 'title'=>$tour->title],
    ['url'=>route('admin.tour.finance.index', $tour), 'title'=>__('Finance')],
    ['url'=>route('admin.tour.finance.create', $tour), 'title'=>__('Create')],
    ]) !!}
    <div class="row">
        <div class="col-12 col-md-3 col-xl-2">
            @include('admin.tour.includes.edit-tabs')
        </div>
        <div class="col-12 col-md-9 col-xl-10">
            <x-page.edit :title="__('Create')"
                         :backUrl="route('admin.tour.finance.index', $tour)"
                         :updateUrl="route('admin.tour.finance.store', $tour)"
                         :expanded="true"
            >

                @include('admin.tour.finance.form')
            </x-page.edit>

        </div>
    </div>


@endsection
