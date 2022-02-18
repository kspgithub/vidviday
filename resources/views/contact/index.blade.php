@extends('layout.app')
@section('title', !empty($pageContent->seo_title) ? $pageContent->seo_title : $pageContent->title)
@section('seo_description', !empty($pageContent->seo_description) ? $pageContent->seo_description : $pageContent->title)
@section('seo_keywords', !empty($pageContent->seo_keywords) ? $pageContent->seo_keywords : $pageContent->title)
@section('content')
    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->
            <div class="bread-crumbs">
                <a href="{{('/')}}">@lang('Home')</a>
                <span>—</span>
                <span>{{$pageContent->title}}</span>
            </div>
            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="order-xl-1 order-2 col-xl-3 col-12">
                    <!-- SIDEBAR -->
                @include('includes.sidebar')
                <!-- SIDEBAR END -->
                </div>

                <div class="order-xl-2 order-1 col-xl-9 col-12">
                    <x-tour.mobile-search-btn/>

                    <!-- BANNER/INFO -->
                @include('contact.includes.banner')
                <!-- BANNER/INFO END -->
                    <div class="spacer-xs"></div>
                    <!-- MAP -->
                    <div v-is="'map-route'"
                         :lat='{{$contact->lat}}'
                         :lng='{{$contact->lng}}'
                         :address='"{{$contact->title}}"'
                         :address-comment='"{{$contact->address_comment}}"'
                    ></div>
                    <!-- MAP END -->
                    <div class="spacer-xs"></div>
                    <!-- ACCORDIONS CONTENT -->
                    <div class="accordion-all-expand">
                        <div class="expand-all-button">
                            <div class="expand-all open">{{__('common.expand-all')}}</div>
                            <div class="expand-all close">{{__('common.collapse-all')}}</div>
                        </div>
                        <div class="accordion type-4">
                            <div class="accordion-item active">
                                <div class="accordion-title">{{__('common.corporate-orders')}}<i></i></div>
                                <div class="accordion-inner" style="display: block;">
                                    <div class="thumb-wrap row">
                                        @foreach ($specCorporate as $specialist)
                                            <div class="col-lg-4 col-md-6 col-12">
                                                <x-staff.card :specialist="$specialist" :label="false"/>

                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <div class="accordion-title">{{__('common.agency-cooperation')}}<i></i></div>
                                <div class="accordion-inner">
                                    <div class="thumb-wrap row">
                                        @foreach ($specAgencies as $specialist)
                                            <div class="col-lg-4 col-md-6 col-12">
                                                <x-staff.card :specialist="$specialist" :label="false"/>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="expand-all-button">
                            <div class="expand-all open">{{__('common.expand-all')}}</div>
                            <div class="expand-all close">{{__('common.collapse-all')}}</div>
                        </div>
                    </div>
                    <!-- ACCORDIONS CONTENT END -->
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>
        <!-- SEO TEXT -->
        <x-page.regulations/>
        <!-- SEO TEXT END -->
    </main>
@endsection
