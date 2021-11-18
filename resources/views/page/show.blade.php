@extends('layout.app')

@section('title', !empty($pageContent->seo_title) ? $pageContent->seo_title : $pageContent->title)
@section('seo_description', !empty($pageContent->seo_description) ? $pageContent->seo_description : $pageContent->title)
@section('seo_keywords', !empty($pageContent->seo_keywords) ? $pageContent->seo_keywords : $pageContent->title)


@section('content')
    <main>
        <div class="container">
            <div class="bread-crumbs">
                <a href="/">@lang('Home')</a>
                <span>—</span>
                <span>{{$pageContent->title}}</span>
            </div>
            <div class="row">
                <div class="col-12 {{$pageContent->sidebar ? 'col-xl-8' : ''}}">
                    <!-- BANNER TABS -->
                @include('page.includes.banner-tabs', [
                    'pictures'=>$pageContent->getMedia(),
                    'video'=>$pageContent->video
                ])
                <!-- BANNER TABS END -->
                    <h1 class="h1 title">{{$pageContent->seo_h1 ?? $pageContent->title}}</h1>
                    <div class="text text-md">
                        {!! $pageContent->text !!}
                    </div>

                </div>

                @if($pageContent->sidebar)
                    <div class="col-xl-4 col-12">
                        <!-- SIDEBAR -->
                    @include('page.includes.right-sidebar')
                    <!-- SIDEBAR END -->
                    </div>
                @endif
            </div>

            <div class="spacer-lg"></div>

            @include('includes.regulations')
        </div>
    </main>
@endsection

