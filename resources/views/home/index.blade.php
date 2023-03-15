@extends('layout.app')
@section('title', !empty($pageContent->seo_title) ? $pageContent->seo_title : $pageContent->title)
@section('seo_description', !empty($pageContent->seo_description) ? $pageContent->seo_description : $pageContent->title)
@section('seo_keywords', !empty($pageContent->seo_keywords) ? $pageContent->seo_keywords : $pageContent->title)

@push('meta-fields')
    {{--    <meta property="fb:app_id" content="">--}}
    {{--    <meta property="og:admins" content="">--}}
    <meta property="og:title"
          content="{{ !empty($pageContent->seo_title) ? $pageContent->seo_title : $pageContent->title }}">
    <meta property="og:description"
          content="{{ !empty($pageContent->seo_description) ? $pageContent->seo_description : $pageContent->title }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($pageImage = $pageContent->getFirstMedia() ?: App\Models\Page::where('key', 'home')->first()?->getFirstMedia())
        <meta property="og:image" content="{{ $pageImage->getFullUrl() }}">
    @endif
    <meta property="og:type" content="product">
    <meta property="og:site_name" content="{{ route('home') }}">
@endpush

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
        <x-page.clients/>
        <!-- OUR CLIENTS END -->

        <!-- SEO TEXT -->
        <x-page.regulations :model="$pageContent" :h1="$pageContent->seo_h1"/>
        <!-- SEO TEXT END -->
    </main>

@endsection
