@extends('admin.layout.app')

@section('title', __('Translation'))

@section('content')
    <div class="mb-2">
        {!! breadcrumbs([
            ['url'=>route('admin.dashboard'), 'title'=>__('Home')],
            ['url'=>route('admin.translation.index'), 'title'=>__('Translations')],
        ]) !!}
    </div>
    <div class="d-flex justify-content-between">
        <h1>@lang('Translations')</h1>

        <div class="d-flex align-items-center">
            @if(current_user()->isMasterAdmin())
                <a href="{{route('admin.translation.create')}}" class="btn btn-sm btn-outline-info"><i data-feather="feather"></i> @lang('Create Translation')</a>
            @endif
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <livewire:language-line-table />
        </x-slot>
    </x-bootstrap.card>


@endsection
