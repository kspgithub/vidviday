@extends('admin.layout.app')

@section('title', 'Країни')

@section('content')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
    ['url'=>route('admin.country.index'), 'title'=>__('Countries')],
    ]) !!}
    <div class="d-flex justify-content-between">
        <h1>Країни</h1>

        <div class="d-flex align-items-center">
            @if(current_user()->isMasterAdmin())
                <a href="{{route('admin.country.create')}}" class="btn btn-sm btn-outline-info">
                    <i data-feather="plus"></i> @lang('Create country')
                </a>
            @endif
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <table class="table table-responsive table-striped table-sm">
                <thead>
                <tr>
                    <th>@lang('title')</th>
                    <th>@lang('Iso')</th>
                    {{--                    <th>@lang('Key')</th>--}}
                    <th style="width: 200px">@lang('Actions') </th>
                </tr>
                </thead>
                <tbody>
                @foreach($countries as $country)
                    <tr>
                        <td>{{$country->title}}</td>
                        <td>{{$country->iso}}</td>
                        {{--                        <td>{{$country->slug}}</td>--}}
                        <td>
                            <x-utils.edit-button :href="route('admin.country.edit', ['country'=>$country])" text=""/>
                            @if(current_user()->isMasterAdmin())
                                <x-utils.delete-button :href="route('admin.country.destroy', $country)" text=""/>
                            @endif
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

    {{ $countriesPaginated->onEachSide(1)->links() }}

@endsection

@push('before-scripts')
    <script>
        /*** Fix Lara Paginator ***/
            // p (calculate) style
        let childDiv = document.querySelectorAll('[role="navigation"]')[0];
        childDiv.getElementsByTagName('div')[1].firstElementChild.firstElementChild.style.marginTop = '15px';
        // paginate View fix for arrows
        if (document.querySelectorAll('[aria-label="&laquo; Назад"]')[0] !== undefined)
            document.querySelectorAll('[aria-label="&laquo; Назад"]')[0].style.display = 'none';
        if (document.querySelectorAll('[rel="next"]')[0] !== undefined)
            document.querySelectorAll('[rel="next"]')[0].style.display = 'none';
        if (document.querySelectorAll('[rel="prev"]')[0] !== undefined)
            document.querySelectorAll('[rel="prev"]')[0].style.display = 'none';
    </script>
@endpush
