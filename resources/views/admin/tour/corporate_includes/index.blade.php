@extends('admin.layout.app')

@section('title', __('Editing tour') .'-'.__('Corporate includes'))

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
['url'=>route('admin.tour.edit', $tour), 'title'=>$tour->title],
['url'=>'#', 'title'=>__('Finance')],
]) !!}
    <h1 class="mb-3">@lang('Editing tour') "{{$tour->title}}" - @lang('Corporate includes')</h1>
    <div class="row">
        <div class="col-12 col-md-3 col-xl-2">
            @include('admin.tour.includes.edit-tabs')
        </div>
        <div class="col-12 col-md-9 col-xl-10">
            <x-bootstrap.card>
                <x-slot name="header">
                    <h3>@lang('Corporate includes')</h3>
                </x-slot>
                <x-slot name="body">
                    <form method="post">
                        @csrf

                        <x-forms.checkbox-group name="corporate_includes[]"
                                                :label="__('Include in price')"
                                                :options="$corporateIncludes"
                                                :value="$tour->corporate_includes"
                        />

                        <button type="submit" class="btn btn-primary me-3">@lang('Save')</button>
                    </form>

                </x-slot>
            </x-bootstrap.card>
        </div>
    </div>

@endsection
