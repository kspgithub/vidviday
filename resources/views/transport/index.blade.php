@extends('layout.app')
@section('title', !empty($pageContent->seo_title) ? $pageContent->seo_title : $pageContent->title)
@section('seo_description', !empty($pageContent->seo_description) ? $pageContent->seo_description : $pageContent->title)
@section('seo_keywords', !empty($pageContent->seo_keywords) ? $pageContent->seo_keywords : $pageContent->title)
@section('content')
    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->
            <div class="bread-crumbs">
                <a href="/">@lang('Home')</a>
                <span>—</span>
                <span>@lang('Transport')</span>
            </div>
            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="col-xl-8 col-12">
                    <!-- BANNER TABS -->
                @include('page.includes.banner-tabs', [
                   'pictures'=>$pageContent->getMedia(),
                   'video'=>$pageContent->video
               ])
                <!-- BANNER TABS END -->
                    <div class="spacer-xs"></div>
                    <!-- TRANSPORT CONTENT -->
                    <div class="tour-content nn">
                        <h1 class="h1 title">{{$pageContent->seo_h1 ?? $pageContent->title}}</h1>
                        <div class="spacer-xs only-desktop-9"></div>
                        <div class="only-pad-mobile">
                            <x-page.social-share/>
                            <div class="spacer-xs"></div>
                            <span class="btn type-1 btn-block">Замовити автобус</span>
                            <div class="spacer-xs"></div>
                        </div>
                        <div>
                            {!! $pageContent->text !!}
                        </div>
                        <div class="spacer-xs"></div>

                        @include('transport.includes.transport')
                        @include('transport.includes.mobile-swiper')

                        <div class="spacer-xs"></div>

                        <x-page.contact-block :staff="$pageContent->staff" title="Співпраця з перевізниками"/>

                        <div class="bg-box" id="transport-form" v-is="'order-transport-form'"></div>

                    </div>
                    <!-- TRANSPORT CONTENT END -->
                </div>

                <div class="col-xl-4 col-12">
                    <!-- SIDEBAR -->
                @include('page.includes.right-sidebar', ['button'=>['title'=>'Замовити автобус', 'url'=>'#transport-form'], 'pageContent'=>$pageContent])
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
