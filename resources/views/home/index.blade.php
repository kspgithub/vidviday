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

                    @include('home.includes.banner')

                    <div v-is="'tour-search'">
                        <!-- MOBILE BUTTONS BAR -->
                    @include('includes.mobile-btns-bar')
                    <!-- MOBILE BUTTONS BAR END -->

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
                    </div>
                </div>
            </div>
            <div class="spacer-xs"></div>
        </div>

        <!-- ACHIEVEMENTS SECTION -->
    @include('home.includes.achievements')
    <!-- ACHIEVEMENTS SECTION END -->

        <!-- OUR CLIENTS -->
    @include('home.includes.partners')
    <!-- OUR CLIENTS END -->

        <!-- SEO TEXT -->
    @include('home.includes.seo-text')
    <!-- SEO TEXT END -->
    </main>

@endsection
