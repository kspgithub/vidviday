@extends('layout.app')

@section('title', $group ? $group->seo_title : 'Пошук турів')

@section('content')
    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->
            <div class="bread-crumbs">
                <a href="/">Головна</a>
                <span>—</span>
                <span>{{$group ? $group->title :  'Пошук турів'}}</span>
            </div>
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
                        <div class="banner-img">
                            <img src="{{asset("/img/preloader.png")}}" data-img-src="{{asset("/img/banner-img_3.jpg")}}"
                                 height="500" alt="banner img 3">
                        </div>
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
                                    <div v-is="'more-text'">
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
                        <div class="only-pad-mobile">
                            <div class="spacer-xs"></div>
                            <span id="tour-selection-btn" class="btn type-5 arrow-right text-left flex"><img {{asset("/img/preloader.png")}} data-img-{{asset("icon/filter-dark.svg")}} alt="filter-dark">Підбір туру</span>
                            <div class="spacer-xs"></div>
                        </div>
                    </div>
                    <!-- BANNER/INFO END -->

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
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>

        <!-- SEO TEXT -->
        <x-page.regulations/>
        <!-- SEO TEXT END -->
    </main>
@endsection