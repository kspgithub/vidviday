@extends('admin.layout.app')

@section('title', __('Editing tour'))

@section('content')
    {!! breadcrumbs([
 ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
 ['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
 ['url'=>route('admin.tour.edit', $tour), 'title'=>$tour->title],
]) !!}

    <h1 class="mb-3">@lang('Editing tour') "{{$tour->title}}" - @lang('Basic information')</h1>
    <div x-data="translatable({ expanded:false, share: { plan: { text: {{json_encode($tour->plan->getTranslations('text'))}} }, locales: {{json_encode($tour->locales)}} } })">
        <x-forms.patch :action="route('admin.tour.update', $tour)" enctype="multipart/form-data" x-ref="form">
            <div class="row">
                <div class="col-12 col-md-3 col-xl-2">
                    @include('admin.tour.includes.edit-tabs')
                </div>
                <div class="col-12 col-md-9 col-xl-10">
                    @include('admin.tour.includes.form')
                    <button class="btn btn-primary" type="submit"
                            x-on:click.prevent="submit($event)">@lang('Save')</button>

                </div>
            </div>


        </x-forms.patch>
    </div>


@endsection
