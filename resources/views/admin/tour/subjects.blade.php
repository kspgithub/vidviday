@extends('admin.layout.app')

@section('title', __('Editing tour') .'-'.__('Subjects'))

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
['url'=>route('admin.tour.edit', $tour), 'title'=>$tour->title],
['url'=>'#', 'title'=>__('Subjects')],
]) !!}
    <h1 class="mb-3">@lang('Editing tour') "{{$tour->title}}" - @lang('Subjects')</h1>

    @include('admin.tour.includes.edit-tabs')

    <x-forms.patch :action="route('admin.tour.subject.update', $tour)">
        <x-bootstrap.card>
            <x-slot name="body">
                <h2>@lang('Subjects')</h2>

                <x-forms.checkbox-group name="subjects[]"
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
