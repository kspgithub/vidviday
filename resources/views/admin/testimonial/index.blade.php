@extends('admin.layout.app')

@section('title', __('Testimonials'))



@section('content')
    <h1 class="mb-3"> @lang('Testimonials')</h1>
    <div class="row">

        <div class="col-12">
            <x-bootstrap.card>
                <x-slot name="body">
                    <livewire:testimonials-table/>
                </x-slot>
            </x-bootstrap.card>

        </div>
    </div>


@endsection

