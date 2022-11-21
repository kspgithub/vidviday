@extends('layout.app')

@section('title', $group ? $group->seo_title : 'Пошук турів')

@push('meta-fields')
    {{--    <meta property="fb:app_id" content="">--}}
    {{--    <meta property="og:admins" content="">--}}
    <meta property="og:title" content="{{ !empty($group->seo_title) ? $group->seo_title : $group->title }}">
    <meta property="og:description" content="{{ !empty($group->seo_description) ? $group->seo_description : $group->title }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($pageImage = $group->getFirstMedia())
        <meta property="og:image" content="{{ $pageImage->getFullUrl() }}">
    @endif
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
                    <span itemprop="title">{{ $group ? $group->title : __('Пошук турів') }}</span>
                </li>
            </ul>
            <!-- BREAD CRUMBS END -->
            <div class="row mobile-reverse-content">
                <div class="col-xl-3 offset-xl-0 col-lg-8 offset-lg-2 col-12">
                    <!-- SIDEBAR -->
                @include('includes.sidebar')
                <!-- SIDEBAR END -->
                </div>

                <div class="col-xl-9 col-12">
                    <!-- BANNER/INFO -->
                    <div class="section">
                        @if($media = $group->getFirstMedia())
                        <div class="banner-img">
                            <img src="{{asset("/img/preloader.png")}}"
                                 data-img-src="{{$media->getUrl()}}"
                                 alt="{{ $media->alt ?: $group->title }}">
                        </div>
                        @endif
                        <div class="spacer-xs"></div>
                        <div class="row">
                            <div class="col-xl-8 col-12">
                                <h1 class="h1 title">{{$group ? (!empty($group->seo_h1) ? $group->seo_h1 : $group->title) : __('Tours')}}</h1>
                                <div class="spacer-xs"></div>
                                <div class="only-pad-mobile">
                                    @include('tour.includes.social-share')
                                    <div class="spacer-xs"></div>
                                </div>
                                @if($group)
                                    <div v-is="'more-text'" spacer="xs">
                                        {!! $group->text !!}
                                    </div>
                                @endif
                                <div class="spacer-xs"></div>
                                <div class="only-desktop only">
                                    <hr>
                                    <div class="spacer-xs"></div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-12">
                                <div class="bordered-box">
                                    <div class="thumb-price text-center-sm">
                                        <span class="text"><b>Ціна:</b> від <span>{{ceil($min_price)}}</span> до <span>{{ceil($max_price)}}</span><sup>грн</sup></span>
                                    </div>
                                    <div class="only-desktop only">
                                        <hr>
                                        @include('tour.includes.social-share')
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="spacer-xs"></div>
                    </div>
                    <!-- BANNER/INFO END -->

                    <tour-search v-is="'tour-search'" :in-future="false" :group='@json($group)'>
                        <div class="tabs">
                            @include('tour.includes.tab-nav')
                            <div class="spacer-xs"></div>
                            <div class="tabs-wrap">
                                <!-- TAB #1 -->
                                @include('tour.includes.tab-gallery')
                                <!-- TAB #1 END -->

                                <!-- TAB #2 -->
                                @include('tour.includes.tab-list')
                                <!-- TAB #2 END -->

                                <!-- TAB #3 -->
                                @include('tour.includes.tab-calendar')
                                <!-- TAB #3 END -->
                            </div>
                        </div>
                    </tour-search>
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>

        <!-- SEO TEXT -->
        <x-page.regulations :model="$group"/>
        <!-- SEO TEXT END -->
    </main>
@endsection
