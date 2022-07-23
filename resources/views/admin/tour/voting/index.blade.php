@extends('admin.layout.app')

@section('title', __('Editing tour') .'-'.__('Voting'))

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
['url'=>route('admin.tour.edit', $tour), 'title'=>$tour->title],
['url'=>'#', 'title'=>__('Voting')],
]) !!}
    <h1 class="mb-3">@lang('Editing tour') "{{$tour->title}}" - @lang('Voting')</h1>
    <div class="row">
        <div class="col-12 col-md-3 col-xl-2">
            @include('admin.tour.includes.edit-tabs')
        </div>
        <div class="col-12 col-md-9 col-xl-10">
            <x-bootstrap.card>
                <x-slot name="body">
                    <h2 class="mb-2">@lang('Voting')</h2>

                    <div class="row mb-4">
                        <div class="col-12 mb-2 text-lg-end">
                            <a href="{{route('admin.tour.voting.index', ['tour' => $tour, 'export' => 1])}}"
                               target="_blank" class="btn btn-outline-success">
                                <i class="far fa-file-excel"></i> Експортувати в Excel
                            </a>
                        </div>
                    </div>


                    <livewire:tour-votings :tour="$tour"/>

                </x-slot>
            </x-bootstrap.card>
        </div>
    </div>

@endsection
