@extends('layout.app')

@section('content')
    <main>
        <div class="container">
            <div class="row short-distance mobile-reverse-content">
                <div class="col-xl-3 offset-xl-0 col-lg-8 offset-lg-2 col-12">
                    <!-- SIDEBAR -->
                    @include('includes.sidebar')
                    <!-- SIDEBAR END -->
                </div>

                <div class="col-xl-9 col-12">

                    <tour-search v-is="'tour-search'" show-title :in-future="false">
                        @if($tours->count() > 0)
                            <!-- MOBILE BUTTONS BAR -->
                            @include('includes.mobile-btns-bar')
                            <!-- MOBILE BUTTONS BAR END -->
                            <div class="text text-lg" v-is="'tour-request-title'">
                                <p>
                                    @lang('tours-section.found')
                                    <b class="text-bold">
                                        {{$tours->total()}} {{plural_form($tours->total(), [
                                     __('tours-section.one_tour'),
                                     __('tours-section.two_tours'),
                                     __('tours-section.many_tours')
                                    ])}}
                                    </b>
                                    @if(!empty($request_title))
                                        @lang('tours-section.on_request')
                                        <b class="text-bold">{{urldecode($request_title)}}</b>
                                    @endif
                                </p>
                            </div>
                            <div class="spacer-xs"></div>
                            <hr>
                            <div class="spacer-xs"></div>


                            <div class="tabs">

                                @include('home.includes.tab-nav')
                                <div class="tabs-wrap">
                                    <!-- TAB #1 -->
                                    @include('home.includes.tab-gallery')
                                    <!-- TAB #1 END -->

                                    <!-- TAB #2 -->
                                    @include('home.includes.tab-list')
                                    <!-- TAB #2 END -->

                                    <!-- TAB #3 -->
                                    @include('home.includes.tab-calendar')
                                    <!-- TAB #3 END -->
                                </div>
                            </div>
                        @else
                            <div class="only-pad-mobile">
                                <x-seo-button :code="'tour.select'" id="tour-selection-btn"
                                              class="btn type-5 arrow-right text-left flex">
                                    <img loading="lazy" src="{{asset('/img/preloader.png')}}"
                                         data-src="{{asset('/icon/filter-dark.svg')}}" alt="filter-dark">
                                    @lang('tours-section.search-btn')
                                </x-seo-button>
                                    <div class="spacer-xs"></div>
                            </div>
                            <div class="section text-center">
                                <div class="spacer-xs"></div>
                                <h1 class="h1 title">@lang('tours-section.empty-results')</h1>
                                <div class="text text-md">
                                    <p>@lang('tours-section.empty-proposal')</p>
                                </div>
                                <div class="spacer-xs"></div>
                                <x-seo-button :code="'goto.home'" href="{{route('home')}}"
                                              class="btn type-1">@lang('tours-section.go-home')</x-seo-button>
                                    <div class="spacer-lg"></div>
                                    <hr>
                                    <div class="spacer-xs"></div>
                            </div>
                            <x-tour.popular/>
                        @endif
                    </tour-search>
                </div>

            </div>
            <div class="spacer-xs"></div>
        </div>


        <!-- SEO TEXT -->
        <x-page.regulations :model="null"/>
        <!-- SEO TEXT END -->
    </main>

@endsection

