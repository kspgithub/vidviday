@extends('layout.app')
@section('title', !empty($pageContent->seo_title) ? $pageContent->seo_title : $pageContent->title)
@section('seo_description', !empty($pageContent->seo_description) ? $pageContent->seo_description : $pageContent->title)
@section('seo_keywords', !empty($pageContent->seo_keywords) ? $pageContent->seo_keywords : $pageContent->title)
@section('content')
    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->
            <div class="bread-crumbs">
                <a href="{{ '/' }}">Головна</a>
                <span>—</span>
                <span>{{$pageContent->seo_h1 ?? $pageContent->title}}</span>
            </div>
            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="col-xl-8 col-12">
                    <!-- DOCUMENTS CONTENT -->
                    <h1 class="h1 title">{{$pageContent->seo_h1 ?? $pageContent->title}}</h1>
                    <div class="spacer-xs"></div>
                    <div class="only-pad-mobile">
                        @include('staff.includes.social-share')
                        <div class="spacer-xs"></div>
                    </div>
                    <div class="text text-md">
                        <p>{{$pageContent->text}}</p>
                    </div>
                    <div class="spacer-xs"></div>
                    <div class="thumb-wrap row">
                        @foreach ($documents as $document)
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="bordered-box doc">
                                    <div class="img open-popup" data-rel="gallery-popup">
                                        <img src="{{asset('img/preloader.png')}}"
                                             data-img-src="{{$document->image ?? asset('img/no-image.png')}}"
                                             alt="{{$document->title}}">
                                    </div>
                                    <span class="text text-medium">{{$document->title}}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- DOCUMENTS CONTENT END -->
                </div>

                <div class="col-xl-4 col-12">
                    <!-- SIDEBAR -->
                @include('transport.includes.right-sidebar')
                <!-- SIDEBAR END -->
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>

        <!-- SEO TEXT -->
    @include('home.includes.seo-text')
    <!-- SEO TEXT END -->
    </main>

@endsection
