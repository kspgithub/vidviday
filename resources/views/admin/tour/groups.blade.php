@extends('admin.layout.app')

@section('title', __('Editing tour') .'-'.__('Groups'))

@section('content')
    <h1 class="mb-3">@lang('Editing tour') "{{$tour->title}}" - @lang('Groups')</h1>

    @include('admin.tour.includes.edit-tabs')

    <x-forms.patch :action="route('admin.tour.group.update', $tour)">
        <x-bootstrap.card>
            <x-slot name="body">
                <h2>@lang('Groups')</h2>

                <x-forms.checkbox-group name="groups[]"
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
