@extends('admin.layout.app')

@section('title', __('Blog'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Blog management')</h1>

        <div class="d-flex align-items-center">
            @if(current_user()->isMasterAdmin())
                <a href="{{route('admin.blog.create')}}" class="btn btn-sm btn-outline-info"><i
                        data-feather="plus"></i> @lang('Create')</a>
            @endif
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <table class="table table-responsive table-striped table-sm">
                <thead>
                <tr>

                    <th>@lang('Title')</th>
                    <th>@lang('Published')</th>
                    <th>@lang('Pictures')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($blogs as $blog)
                    <tr>
                        <td>{{$blog->title}}</td>

                        <td>{{$blog->published}}</td>



                        <td><a href="{{route('admin.blog.picture.index', ['blog' => $blog])}}"
                               class="badge bg-info"><span>{{ $blog->media()->where("collection_name", "pictures")->count() }}</span></a></td>
                        <td class="table-action">

                            <x-utils.edit-button :href="route('admin.blog.edit', ['blog'=>$blog])"
                                                 text=""/>
                            @if(current_user()->isMasterAdmin())
                                <x-utils.delete-button :href="route('admin.blog.destroy', $blog)" text=""/>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

@endsection
