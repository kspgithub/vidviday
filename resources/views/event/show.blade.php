@extends('layout.app')

@section('title', !empty($event->seo_title) ? $event->seo_title : $event->title)
@section('seo_description', !empty($event->seo_description) ? $event->seo_description : $event->title)
@section('seo_keywords', !empty($event->seo_keywords) ? $event->seo_keywords : $event->title)

@push('meta-fields')
    {{--    <meta property="fb:app_id" content="">--}}
    {{--    <meta property="og:admins" content="">--}}
    <meta property="og:title" content="{{ !empty($event->seo_title) ? $event->seo_title : $event->title }}">
    <meta property="og:description" content="{{ !empty($event->seo_description) ? $event->seo_description : $event->title }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $event->getFirstMedia()->getFullUrl() }}">
    <meta property="og:type" content="product">
    <meta property="og:site_name" content="{{ route('home') }}">
@endpush

@section('content')
    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->
            <ul class="bread-crumbs">
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a href="{{ route('home') }}" itemprop="url">
                        <span itemprop="title">{{ __("Home") }}</span>
                    </a>
                </li>
                <li>
                    <span>—</span>
                </li>
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a href="{{ pageUrlByKey('events') }}" itemprop="url">
                        <span itemprop="title">{{ __("Events") }}</span>
                    </a>
                </li>
                <li>
                    <span>—</span>
                </li>
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                    <span itemprop="title">{{ $event->title }}</span>
                </li>
            </ul>
            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="order-xl-1 order-2 col-xl-3 col-12">
                    <!-- SIDEBAR -->
                @include('includes.sidebar')
                <!-- SIDEBAR END -->
                </div>

                <div class="order-xl-2 order-1 col-xl-9 col-12">
                    @include('page.includes.banner-tabs', [
                           'pictures'=>$event->getMedia(),
                           'video'=>$event->video
                       ])
                    <div class="spacer-xs"></div>
                    <h1 class="h1 title">{{!empty($event->seo_h1) ?$event->seo_h1 : $event->title}}</h1>
                    <div class="text text-md">
                        {!! $event->text !!}
                    </div>

                    <div class="spacer-xs"></div>
                    <x-tour.mobile-search-btn/>

                    <x-tour.popular/>
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>

        <!-- SEO TEXT -->
        <x-page.regulations :model="$event"/>
        <!-- SEO TEXT END -->
        <!-- MOBILE BUTTONS BAR -->
    @include('includes.mobile-btns-bar')
    <!-- MOBILE BUTTONS BAR END -->
    </main>
@endsection
