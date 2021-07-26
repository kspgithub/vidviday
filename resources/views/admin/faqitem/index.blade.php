@extends('admin.layout.app')

@section('title', __('FAQ management'))

@section('content')

    <div class="d-flex justify-content-between">
        <h1>@lang('FAQ management')</h1>

        <div class="d-flex align-items-center">
            @if(current_user()->isMasterAdmin())
                <a href="{{route('admin.faqitem.create')}}" class="btn btn-sm btn-outline-info"><i data-feather="user-plus"></i> @lang('Create faqitem')</a>
            @endif
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <table class="table table-responsive table-striped table-sm">
                <thead>
                <tr>
                    <th>@lang('section')</th>
                    <th>@lang('question')</th>
                    <th>@lang('answer')</th>
                    <th></th>
                    <th>@lang('Actions') </th>
                </tr>
                </thead>
                <tbody>
                @foreach($faqitems as $faqitem)
                    <tr>
                        <td>{{$faqitem->section}}</td>
                        <td>
                            {{$faqitem->question}}
                            </td>
                        <td>{{$faqitem->answer}}</td>
                        <td>{{$faqitem->sort_order}}</td>
                        <td>{{$faqitem->published}}</td>
                        <td class="table-action">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <x-utils.edit-button :href="route('admin.faqitem.edit', ['faqitem'=>$faqitem])" text="" />
                            @if(current_user()->isMasterAdmin())
                                <x-utils.delete-button :href="route('admin.faqitem.destroy', $faqitem)" text="" />
                            @endif
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>
@endsection
