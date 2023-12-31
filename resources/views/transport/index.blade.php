@extends('layout.app')

@section('title', !empty($pageContent->seo_title) ? $pageContent->seo_title : $pageContent->title)
@section('seo_description', !empty($pageContent->seo_description) ? $pageContent->seo_description : $pageContent->title)
@section('seo_keywords', !empty($pageContent->seo_keywords) ? $pageContent->seo_keywords : $pageContent->title)

@push('meta-fields')
    {{--    <meta property="fb:app_id" content="">--}}
    {{--    <meta property="og:admins" content="">--}}
    <meta property="og:title" content="{{ !empty($pageContent->seo_title) ? $pageContent->seo_title : $pageContent->title }}">
    <meta property="og:description" content="{{ !empty($pageContent->seo_description) ? $pageContent->seo_description : $pageContent->title }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($pageImage = $pageContent->getFirstMedia() ?: App\Models\Page::where('key', 'home')->first()?->getFirstMedia())
<meta property="og:image" content="{{ $pageImage->getFullUrl() }}">
    @endif
<meta property="og:type" content="product">
    <meta property="og:site_name" content="{{ route('home') }}">
@endpush
@php
$bodyClass = 'no-logo';

@endphp

@section('content')
    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->
            <ul class="bread-crumbs" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="{{ route('home') }}" itemprop="item">
                        <span itemprop="name">{{ __("Home") }}</span>
                    </a>
                    <meta itemprop="position" content="1" />
                </li>
                <li>
                    <span>—</span>
                </li>
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name">@lang('Transport')</span>
                    <meta itemprop="position" content="2" />
                </li>
            </ul>
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
                    <div class="tour-content nn trnsprt">
                        <h1 class="h1 title">{{$pageContent->seo_h1 ?? $pageContent->title}}</h1>
                        <div class="only-print"> <?echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?></div>
                        <div class="spacer-xs only-desktop-9"></div>
                        <div class="only-pad-mobile">
                            <x-page.social-share  :share-url="route('page.show', $pageContent->slug)" :share-title="$pageContent->title"/>
                            <div class="spacer-xs"></div>
                            <x-seo-button :code="'order.transport'" class="btn type-1 btn-block" href="#transport-form">{{ __('order-section.order-bus') }}</x-seo-button>
                            <div class="spacer-xs"></div>
                        </div>
                        <div class="text text-md">
                            {!! $pageContent->text !!}
                        </div>
                        <div class="spacer-xs"></div>

                        @include('transport.includes.transport')
                        @include('transport.includes.mobile-swiper')

                        <div class="spacer-xs"></div>

                        <x-page.contact-block :staff="$pageContent->contact" title="Співпраця з перевізниками"/>

                        <div class="bg-box" id="transport-form" v-is="'order-transport-form'" :durations="{{ json_encode($transportDurations) }}"></div>

                    </div>
                    <!-- TRANSPORT CONTENT END -->
                </div>

                <div class="col-xl-4 col-12">
                    <!-- SIDEBAR -->
                @include('page.includes.right-sidebar', ['button'=>['title'=>__('order-section.order-bus'), 'url'=>'#transport-form'], 'pageContent'=>$pageContent])
                <!-- SIDEBAR END -->
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>

        <!-- SEO TEXT -->
        <x-page.regulations :model="$pageContent"/>
        <!-- SEO TEXT END -->
    </main>

@endsection
