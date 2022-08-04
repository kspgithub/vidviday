@extends('admin.layout.app')

@section('title', __('Subscriptions'))

@section('content')
    <h1 class="mb-3"> @lang('User Subscriptions')</h1>
    <div class="row">

        <div class="col-12">
            <x-bootstrap.card>
                <x-slot name="body">
                    <livewire:user-subscriptions-table/>
                </x-slot>
            </x-bootstrap.card>

        </div>
    </div>
@endsection

