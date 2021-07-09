@extends('admin.layout.app')

@section('title', __('City management'))

@section('content')

    <div class="d-flex justify-content-between">
        <h1>@lang('City management')</h1>

        <div class="d-flex align-items-center">
            @if(current_user()->isMasterAdmin())
                <a href="{{route('admin.city.create')}}" class="btn btn-sm btn-outline-info"><i data-feather="user-plus"></i> @lang('Create city')</a>
            @endif
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <table class="table table-responsive table-striped table-sm">
                <thead>
                <tr>

                    <th>@lang('Country')</th>
                    <th>@lang('Region')</th>
                    <th>@lang('title')</th>
                    <th>@lang('Url')</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @lang('Actions') </th>
                </tr>
                </thead>
                <tbody>
                @foreach($cities as $city)
                    <tr>
                        <td>{{$city->country()->pluck('title')[0]}}</td>
                        <td>{{$city->region()->pluck('title')[0]}}</td>
                        <td>{{$city->title}}</td>
                        <td>{{$city->slug}}</td>
                        <td class="table-action">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <x-utils.edit-button :href="route('admin.city.edit', ['city'=>$city])" text="" />
                            @if(current_user()->isMasterAdmin())
                                <x-utils.delete-button :href="route('admin.city.destroy', $city)" text="" />
                            @endif
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

    {{ $citiesPaginated->onEachSide(1)->links() }}

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
