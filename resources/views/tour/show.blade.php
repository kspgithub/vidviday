@extends('layout.app')

@section('title', !empty($tour->seo_title) ? $tour->seo_title : $tour->title)
@section('seo_description', !empty($tour->seo_description) ? $tour->seo_description : $tour->title)
@section('seo_keywords', !empty($tour->seo_keywords) ? $tour->seo_keywords : $tour->title)

@section('content')
    <main>

        <div class="container">
            <!-- BREAD CRUMBS -->
            <div class="bread-crumbs">
                <a href="/">@lang('Home')</a>
                <span>—</span>
                <a href="{{route('tour.index')}}">@lang('Tours')</a>
                <span>—</span>
                <span>{{$tour->title}}</span>
            </div>
            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="col-xl-8 col-12">
                    <!-- BANNER TABS -->
                @include('tour.includes.banner-tabs', [
                    'tour'=>$tour,
                    'pictures'=>($tour->hasMedia('pictures') ? $tour->getMedia('main')->merge($tour->getMedia('pictures')) : $tour->getMedia('main')),
                ])
                <!-- BANNER TABS END -->
                    <div class="spacer-xs"></div>
                    <!-- TOUR CONTENT -->
                    <div class="tour-content">
                        <div class="row">
                            <div class="col-12 order-md-1">
                                <h1 class="h1 title">{{!empty($tour->seo_h1) ? $tour->seo_h1 : $tour->title}}</h1>
                                <div class="spacer-xs"></div>
                                <div class="only-pad-mobile hidden-print">

                                    <x-tour.star-rating :rating="$tour->rating"
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
                                {{--                                //@dd($tour->accommodations)--}}
                                @include('tour.includes.tour-plan')
                                @include('tour.includes.tour-landing')
                                @include('tour.includes.tour-places')
                                @include('tour.includes.tour-schedule')
                                @include('tour.includes.tour-finances')
                                @include('tour.includes.tour-tickets')

                                @include('tour.includes.tour-fun')

                                @if($tour->transport_on)
                                    @include('tour.includes.tour-transport')
                                @endif

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
         action='{{route('tour.testimonial', $tour)}}'
         :data-parent="0"
    >
        @csrf
    </div>

    <div v-is="'tour-one-click-popup'"
         :tour='@json($tour->shortInfo())'
         :schedules='@json($future_events)'
         action='{{route('tour.order-confirm', $tour)}}'
    >
        @csrf
    </div>
@endpush
