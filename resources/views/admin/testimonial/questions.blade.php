@extends('admin.layout.app')

@section('title', __('Questions'))



@section('content')
    <h1 class="mb-3"> @lang('Questions')</h1>
    <div class="row">

        <div class="col-12">
            <x-bootstrap.card>
                <x-slot name="body">
                    <livewire:questions-table/>
                </x-slot>
            </x-bootstrap.card>

        </div>
    </div>


@endsection

