@extends('admin.layout.app')

@section('title', 'Квитки')

@section("content")
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
    ['url'=>route('admin.ticket.index'), 'title'=>'Квитки'],
    ]) !!}
    <div class="d-flex justify-content-between">
        <h1>Квитки</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.ticket.create')}}" class="btn btn-sm btn-outline-info"><i
                    data-feather="plus"></i> @lang('Create')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <livewire:tickets-table/>
        </x-slot>
    </x-bootstrap.card>

@endsection
