@extends('admin.layout.app')

@section('title', __('Html block management'))

@section('content')

    <div class="d-flex justify-content-between">
        <h1>@lang('Html block management')</h1>

        <div class="d-flex align-items-center">
            @if(current_user()->isMasterAdmin())
                <a href="{{route('admin.html-block.create')}}" class="btn btn-sm btn-outline-info"><i
                        data-feather="user-plus"></i> @lang('Create record')</a>
            @endif
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <table class="table table-responsive table-striped table-sm">
                <thead>
                <tr>
                    <th>@lang('Title')</th>
                    <th>@lang('Key')</th>

                    <th>@lang('Actions') </th>
                </tr>
                </thead>
                <tbody>
                @foreach($htmlBlocks as $htmlBlock)
                    <tr>
                        <td>{{$htmlBlock->title}}</td>
                        <td>{{$htmlBlock->slug}}</td>

                        <td class="table-action">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <x-utils.edit-button :href="route('admin.html-block.edit', ['html_block'=>$htmlBlock])"
                                                 text=""/>
                            @if(current_user()->isMasterAdmin())
                                <x-utils.delete-button :href="route('admin.html-block.destroy', $htmlBlock)" text=""/>
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
