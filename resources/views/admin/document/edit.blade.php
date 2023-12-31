@extends('admin.layout.app')

@section('title', __('Edit document'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Edit document')
            <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div>
        </h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.document.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>
    <x-forms.translatable :action="route('admin.document.update', $document)" enctype="multipart/form-data"
                          method="patch">
        @include('admin.document.includes.form')
    </x-forms.translatable>
@endsection
