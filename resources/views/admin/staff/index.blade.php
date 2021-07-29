@extends('admin.layout.app')

@section('title', __('Staff management'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Staff management')</h1>

        <div class="d-flex align-items-center">
            @if(current_user()->isMasterAdmin())
                <a href="{{route('admin.staff.create')}}" class="btn btn-sm btn-outline-info"><i data-feather="user-plus"></i> @lang('Create staff')</a>
            @endif
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <table class="table table-responsive table-striped table-sm">
                <thead>
                <tr>

                    <th>@lang('type')</th>
                    <th>@lang('first_name')</th>
                    <th>@lang('Locale')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($staffs as $staff)
                    <tr>
                        <td>{{$staff->type}}</td>
                        <td>{{$staff->first_name}}</td>
                        <td>{{app()->getLocale()}}</td>
                        <td class="table-action">

                            <x-utils.edit-button :href="route('admin.staff.edit', ['staff'=>$staff])" text="" />
                            @if(current_user()->isMasterAdmin())
                                <x-utils.delete-button :href="route('admin.staff.destroy', ['staff'=>$staff])" text="" />
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

    {{ $staffsPaginated->onEachSide(1)->links() }}

@endsection
@push('before-scripts')
    <script>
        /*** Fix Lara Paginator ***/
        // p (calculate) style
        let childDiv = document.querySelectorAll('[role="navigation"]')[0];
        childDiv.getElementsByTagName('div')[1].firstElementChild.firstElementChild.style.marginTop = '15px';
        // paginate View fix for arrows
        if(document.querySelectorAll('[aria-label="&laquo; Назад"]')[0] !== undefined)
            document.querySelectorAll('[aria-label="&laquo; Назад"]')[0].style.display = 'none';
        if(document.querySelectorAll('[rel="next"]')[0] !== undefined)
            document.querySelectorAll('[rel="next"]')[0].style.display = 'none';
        if(document.querySelectorAll('[rel="prev"]')[0] !== undefined)
            document.querySelectorAll('[rel="prev"]')[0].style.display = 'none';
    </script>
@endpush
