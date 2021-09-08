@extends('admin.layout.app')

@section('title', __('Contact management'))

@section('content')

    <div class="d-flex justify-content-between">
        <h1>@lang('Contact management')</h1>

        <div class="d-flex align-items-center">
            @if(current_user()->isMasterAdmin())
                <a href="{{route('admin.contact.create')}}" class="btn btn-sm btn-outline-info"><i data-feather="user-plus"></i> @lang('Create contact')</a>
            @endif
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <table class="table table-responsive table-striped table-sm">
                <thead>
                <tr>
                    <th>@lang('title')</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @lang('Actions') </th>
                </tr>
                </thead>
                <tbody>
                @foreach($contacts as $contact)
                    <tr>
                        <td>{{$contact->title}}</td>
                        <td class="table-action">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <x-utils.edit-button :href="route('admin.contact.edit', ['contact'=>$contact])" text="" />
                            @if(current_user()->isMasterAdmin())
                                <x-utils.delete-button :href="route('admin.contact.destroy', $contact)" text="" />
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
