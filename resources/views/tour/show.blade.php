@extends('layout.app')

@section('title', !empty($tour->seo_title) ? $tour->seo_title : $tour->title)
@section('seo_description', !empty($tour->seo_description) ? $tour->seo_description : $tour->title)
@section('seo_keywords', !empty($tour->seo_keywords) ? $tour->seo_keywords : $tour->title)

@push('meta-fields')
    {{--    <meta property="fb:app_id" content="">--}}
    {{--    <meta property="og:admins" content="">--}}
    <meta property="og:title" content="{{ !empty($tour->seo_title) ? $tour->seo_title : $tour->title }}">
    <meta property="og:description"
          content="{{ !empty($tour->seo_description) ? $tour->seo_description : $tour->title }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($pageImage = $pictures->first() ?: App\Models\Page::where('key', 'home')->first()?->getFirstMedia())
        <meta property="og:image" content="{{ $pageImage->getFullUrl() }}">
    @endif
    <meta property="og:type" content="product">
    <meta property="og:site_name" content="{{ route('home') }}">
@endpush

@php
    $bodyClass = 'single-tour';
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
                    <meta itemprop="position" content="1"/>
                </li>
                <li>
                    <span>—</span>
                </li>
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="{{ route('tour.index') }}" itemprop="item">
                        <span itemprop="name">{{ __("Tours") }}</span>
                    </a>
                    <meta itemprop="position" content="2"/>
                </li>
                <li>
                    <span>—</span>
                </li>
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name">{{ $tour->title }}</span>
                    <meta itemprop="position" content="3"/>
                </li>
            </ul>
            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="col-xl-8 col-12">
                    <!-- BANNER TABS -->
                    @include('tour.includes.banner-tabs', [
                        'tour'=>$tour,
                        'pictures'=>$pictures,
                    ])
                    <!-- BANNER TABS END -->
                    <div class="spacer-xs"></div>
                    <!-- TOUR CONTENT -->
                    <div class="tour-content">
                        <div class="row">
                            <div class="col-12 order-md-1">
                                <h1 class="h1 title">{{!empty($tour->seo_h1) ? $tour->seo_h1 : $tour->title}}</h1>
                                <div class="spacer-xs"></div>

                                @if(!is_tour_agent())
                                    <div class="only-print">
                                        <a href="{{$tour->url}}" title="{{$tour->title}}">{{url($tour->url)}}</a>
                                    </div>
                                @endif

                                <div class="only-pad-mobile hidden-print">

                                    <x-tour.star-rating :rating="intval($tour->rating != 0 ? $tour->rating : $tour->testimonials_avg_rating)"
                                                        :count="$tour->testimonials_count"
                                                        :trigger="true"
                                    />

                                    <x-tour.share/>

                                    <x-tour.like-btn :tour="$tour->shortInfo()"/>

                                </div>
                                <div class="spacer-xs only-pad-mobile"></div>
                            </div>

                            <div class="col-xl-12 col-md-5 col-12 order-md-3">
                                <div class="right-sidebar">
                                    <div class="right-sidebar-inner only-mobile">
                                        <x-tour.order-form :tour="$tour"
                                                           :schedules="$future_events->map->shortInfo()"
                                                           :nearest-event="$nearest_event"
                                                           :shareClass="'only-desktop'"
                                                           :spacerClass="'spacer-xs only-desktop'"
                                        />
                                    </div>
                                </div>
                                <div class="spacer-xs"></div>
                            </div>

                            <div class="col-xl-12 col-md-7 col-12 order-md-2">
                                <div class="text text-md border-right-pad">
                                    {!! $tour->text !!}
                                </div>
                                <div class="spacer-xs"></div>
                            </div>
                        </div>

                        <!-- ACCORDIONS CONTENT -->

                        <div class="accordion-all-expand">
                            <div class="expand-all-button">
                                <div class="expand-all open">@lang('tours-section.expand-all')</div>
                                <div class="expand-all close">@lang('tours-section.collapse-all')</div>
                            </div>
                            <div class="accordion type-1">

                                @include('tour.includes.tour-plan')
                                @include('tour.includes.tour-landing')
                                @include('tour.includes.tour-places')
                                @include('tour.includes.tour-schedule')
                                @include('tour.includes.tour-finances')
                                @include('tour.includes.tour-tickets')
                                @include('tour.includes.tour-fun')
                                @include('tour.includes.tour-transport')
                                @include('tour.includes.tour-residence')
                                @include('tour.includes.tour-food')
                                @include('tour.includes.tour-calc')
                                @include('tour.includes.tour-questions')
                                @include('tour.includes.tour-reviews')
                            </div>
                            <div class="expand-all-button">
                                <div class="expand-all open">@lang('tours-section.expand-all')</div>
                                <div class="expand-all close">@lang('tours-section.collapse-all')</div>
                            </div>
                        </div>
                        <!-- ACCORDIONS CONTENT END -->
                    </div>
                    <!-- TOUR CONTENT END -->
                </div>

                <div class="col-xl-4 col-12">
                    <!-- SIDEBAR -->
                    @include('tour.includes.right-sidebar')

                    <!-- SIDEBAR END -->
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>

        <!-- THUMBS CAROUSEL -->
        @include('tour.includes.similar-carousel')
        <!-- THUMBS CAROUSEL END -->

        <!-- SEO TEXT -->
        <x-page.regulations :model="$tour"/>
        <!-- SEO TEXT END -->
    </main>

@endsection

@push('after-popups')
    <div v-is="'tour-calendar-popup'"
         :tour='@json($tour->shortInfo())'
         :events='@json($future_events->map->asCalendarEvent(false))'
         :nearest-event='@json($nearest_event ? $nearest_event->asCalendarEvent(false) : null)'
    >
    </div>
    <div v-is="'tour-testimonial-form'"
         :tour='@json($tour->shortInfo())'
         :user='@json(current_user())'
         :captcha="@json(config('captcha.enabled'))"
         action='{{route('tour.testimonial', $tour)}}'
         :data-parent="0"
    >
        @csrf
    </div>

    <div v-is="'tour-one-click-popup'"
         :tour='@json($tour->shortInfo())'
         :schedules='@json($future_events->map->shortInfo())'
         action='{{route('tour.order-confirm', $tour)}}'
    >
        @csrf
    </div>

    <div v-is="'tour-question-popup-form'"
         :tour='@json($tour->shortInfo())'
         :user='@json(current_user())'
         :captcha="@json(config('captcha.enabled'))"
         action='{{route('tour.question', $tour)}}'
         :data-parent="0"
    >
        @csrf
    </div>

@endpush

@push('after-scripts')
    <script defer
            src="https://maps.googleapis.com/maps/api/js?key={{config('services.google.maps_key')}}&libraries=places&callback=initMap"></script>
    <script defer src="{{ mix('js/libs/map.js', 'assets/app') }}"></script>
@endpush
