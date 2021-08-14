@extends('admin.layout.app')

@section('title', __('Edit event') .'-'.__('Directions'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Edit event') <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div></h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.event.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    @include('admin.event.includes.edit-tabs')

    <x-forms.patch  :action="route('admin.event.direction.update', $event)">
        <x-bootstrap.card>
            <x-slot name="body">
                <h2>@lang('Directions')</h2>

                <x-forms.checkbox-group name="directions[]"
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
