@extends('layout.app')

@section('title', !empty($place->seo_title) ? $place->seo_title : $place->title)
@section('seo_description', !empty($place->seo_description) ? $place->seo_description : $place->title)
@section('seo_keywords', !empty($place->seo_keywords) ? $place->seo_keywords : $place->title)

@push('meta-fields')
    {{--    <meta property="fb:app_id" content="">--}}
    {{--    <meta property="og:admins" content="">--}}
    <meta property="og:title" content="{{ !empty($place->seo_title) ? $place->seo_title : $place->title }}">
    <meta property="og:description"
          content="{{ !empty($place->seo_description) ? $place->seo_description : $place->title }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $place->getFirstMedia()->getFullUrl() }}">
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
                    <a href="{{ route('places') }}" itemprop="url">
                        <span itemprop="title">{{ __("Місця") }}</span>
                    </a>
                </li>
                <li>
                    <span>—</span>
                </li>
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                    <span itemprop="title">{{ $place->title }}</span>
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
                    <!-- BANNER/INFO -->
                    <div class="section">
                        <!-- BANNER TABS -->

                        @include('place.includes.banner-tabs', [
                            'pictures'=>$place->getMedia(),
                            'place'=>$place,
                        ])
                        <!-- BANNER TABS END -->
                        <div class="spacer-xs">
                            {{--                            @dd($place->getMedia())--}}
                        </div>
                        <div class="row">
                            <div class="col-xl-8 col-12">
                                <h1 class="h1 title">{{ $place->title }}</h1>
                                <x-tour.star-rating :rating="4" :count="0"/>

                                <x-sidebar.social-share :share-url="$place->url" :share-title="$place->title"
                                                        class="only-pad-mobile inline-block"/>
                                <div class="seo-text load-more-wrapp">

                                    <div class="less-info">
                                        <div class="text text-md">
                                            {{str_limit(strip_tags(html_entity_decode($place->text)), 300, '...')}}
                                        </div>
                                    </div>
                                    <div class="more-info">
                                        <div class="text text-md">
                                            {!! $place->text !!}
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="spacer-xs"></div>
                                        <div class="show-more">
                                            <span>@lang('tours-section.read-more')</span>
                                            <span>@lang('tours-section.hide-text')</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @include('place.includes.right-block')
                        </div>
                    </div>

                    <div class=" hidden-print">
                        <!-- BANNER/INFO END -->
                        <div class="only-pad-mobile">
                            <div class="spacer-xs"></div>
                            <span id="tour-selection-btn" class="btn type-5 arrow-right text-left flex"><img
                                    src="{{asset('img/preloader.png')}}"
                                    data-img-src="{{asset('icon/filter-dark.svg')}}"
                                    alt="filter-dark">Підбір туру</span>
                            <div class="spacer-xs"></div>
                        </div>
                        <div class="spacer-xs"></div>
                        <h2 class="h2  hidden-print">Ми підібрали тури в які входить це місце:</h2>
                        <div class="spacer-xs"></div>
                        <hr>
                        <div class="spacer-xs"></div>
                        <div class="tabs  hidden-print">

                            @include('home.includes.tab-nav')
                            <div class="tabs-wrap">
                                <!-- TAB #1 -->
                                @include('home.includes.tab-gallery')
                                <!-- TAB #1 END -->

                                <!-- TAB #2 -->
                                @include('home.includes.tab-list')
                                <!-- TAB #2 END -->

                                <!-- TAB #3 -->
                                <div class="tab">
                                    <div class="spacer-xs"></div>
                                    <x-tour.calendar :filter="['place_id'=>$place->id ]"/>
                                </div>
                                <!-- TAB #3 END -->
                            </div>
                        </div>

                        <!-- ACCORDIONS CONTENT -->
                        @include('place.includes.testimonials')
                        <!-- ACCORDIONS CONTENT END -->
                    </div>

                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>

        <!-- SEO TEXT -->
        <x-page.regulations :model="$place"/>
        <!-- SEO TEXT END -->
        <!-- MOBILE BUTTONS BAR -->
        @include('includes.mobile-btns-bar')
        <!-- MOBILE BUTTONS BAR END -->

    </main>

@endsection

@push('after-popups')
    <div v-is="'place-testimonial-form'"
         :place='@json($place->shortInfo())'
         :user='@json(current_user())'
         action='{{route('place.testimonial', $place)}}'
         :data-parent="0"
         :tours='@json($place->tours->map->shortInfo())'
    >
        @csrf
    </div>

@endpush
