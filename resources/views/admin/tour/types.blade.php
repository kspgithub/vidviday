@extends('admin.layout.app')

@section('title', __('Editing tour') .'-'.__('Types'))

@section('content')
    <h1 class="mb-3">@lang('Editing tour') "{{$tour->title}}" - @lang('Types')</h1>

    @include('admin.tour.includes.edit-tabs')

    <x-forms.patch :action="route('admin.tour.type.update', $tour)">
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
