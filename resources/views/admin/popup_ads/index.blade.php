@extends('admin.layout.app')

@section('title', __('Advertisements'))

@section('content')
    {!! breadcrumbs([
        ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
        ['url'=>route('admin.popup_ads.index'), 'title'=>__('Popup Advertisements')],
    ]) !!}

    <div class="d-flex justify-content-between">
        <h1>@lang('Popup Advertisements') </h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.popup_ads.create')}}" class="btn btn-sm btn-outline-info"><i
                    data-feather="plus"></i> @lang('Create record')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>@lang('Image')</th>
                        <th>@lang('Title')</th>
                        <th>@lang('Url')</th>
                        <th>@lang('Published')</th>
                        <th>@lang('Actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($advertisements as $advertisement)
                        <tr>
                            <td>{{$advertisement->id}}</td>
                            <td><img src="{{$advertisement->image_url}}" alt="{{$advertisement->image_alt}}"
                                     style="height: 80px;"></td>
                            <td>{{$advertisement->title}}</td>
                            <td>{{$advertisement->url}}</td>
                            <td>
                                @include('admin.partials.published', ['model' => $advertisement, 'updateUrl' => route('admin.popup_ads.update', $advertisement)])
                            </td>
                            <td class="table-action">
                                <x-utils.edit-button :href="route('admin.popup_ads.edit', $advertisement)" text=""/>
                                <x-utils.delete-button :href="route('admin.popup_ads.destroy', $advertisement)"
                                                       text=""/>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </x-slot>
    </x-bootstrap.card>

    {{$advertisements->links()}}
@endsection
