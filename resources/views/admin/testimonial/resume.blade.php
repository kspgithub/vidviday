@extends('admin.layout.app')

@section('title', __('Resume'))



@section('content')
    <h1 class="mb-3"> @lang('Resume')</h1>
    <div class="row">

        <div class="col-12">
            <x-bootstrap.card>
                <x-slot name="body">
                    <livewire:resume-table/>
                </x-slot>
            </x-bootstrap.card>

        </div>
    </div>


@endsection

