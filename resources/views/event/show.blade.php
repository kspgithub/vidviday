@extends('layout.app')
@section('title', !empty($event->seo_title) ? $event->seo_title : $event->title)
@section('seo_description', !empty($event->seo_description) ? $event->seo_description : $event->title)
@section('seo_keywords', !empty($event->seo_keywords) ? $event->seo_keywords : $event->title)
@section('content')
    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->
            <div class="bread-crumbs">
                <a href="/">@lang('Home')</a>
                <span>—</span>
                <span><a href="{{pageUrlByKey('events')}}">@lang('Events')</a></span>
                <span>—</span>
                <span>{{$event->title}}</span>
            </div>
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
                    <div class="only-pad-mobile">
                        <span id="tour-selection-btn" class="btn type-5 arrow-right text-left flex"><img
                                src="{{asset('img/preloader.png')}}" data-img-src="icon/filter-dark.svg"
                                alt="filter-dark">Підбір туру</span>
                        <div class="spacer-xs"></div>
                    </div>

                    <x-tour.popular/>
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>

        <!-- SEO TEXT -->
    @include('home.includes.seo-text')
    <!-- SEO TEXT END -->
        <!-- MOBILE BUTTONS BAR -->
    @include('includes.mobile-btns-bar')
    <!-- MOBILE BUTTONS BAR END -->
    </main>
@endsection
