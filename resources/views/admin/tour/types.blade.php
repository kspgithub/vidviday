@extends('admin.layout.app')

@section('title', __('Edit tour') .'-'.__('Types'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Edit tour') <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div></h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.tour.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    @include('admin.tour.includes.edit-tabs')

    <x-forms.patch  :action="route('admin.tour.type.update', $tour)">
        <x-bootstrap.card>
            <x-slot name="body">
                <h2>@lang('Types')</h2>

                <x-forms.checkbox-group name="types[]"
                                        :options="$options"
                                        :value="$selected_ids"
                                        label-col="d-none"
                                        input-col="col-12"
                ></x-forms.checkbox-group>
            </x-slot>
            <x-slot name="footer">
                <button class="btn btn-primary" type="submit">@lang('Save')</button>
            </x-slot>
        </x-bootstrap.card>
    </x-forms.patch>


@endsection
