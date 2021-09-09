@extends('admin.layout.app')

@section('title', __('Editing tour') .'-'.__('Directions'))

@section('content')
    <h1 class="mb-3">@lang('Editing tour') "{{$tour->title}}" - @lang('Directions')</h1>

    <div class="row">
        <div class="col-12 col-md-3 col-xl-2">
            @include('admin.tour.includes.edit-tabs')
        </div>
        <div class="col-12 col-md-9 col-xl-10">
            <x-forms.patch :action="route('admin.tour.direction.update', $tour)">
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

        </div>
    </div>

@endsection
