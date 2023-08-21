@extends('admin.layout.app')

@section('title', __('Testimonials'))

@section('content')
    <h1 class="mb-3"> @lang('Testimonials')</h1>
    <a href="#" class="btn btn-sm btn-outline-primary me-3 mb-3" x-data='crmTestimonials()' @click.prevent="importShow()">
        <i class="fa fa-plus"></i> Додати відгуки
    </a>
    @include('admin.testimonial.includes.import-modal')
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

