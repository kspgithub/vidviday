@extends('layout.app')

@section('title', !empty($pageContent->seo_title) ? $pageContent->seo_title : $pageContent->title)
@section('seo_description', !empty($pageContent->seo_description) ? $pageContent->seo_description : $pageContent->title)
@section('seo_keywords', !empty($pageContent->seo_keywords) ? $pageContent->seo_keywords : $pageContent->title)


@section('content')
    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->
            <div class="bread-crumbs">
                <a href="/">@lang('Home')</a>
                <span>—</span>
                <span>@lang('Testimonials')</span>
            </div>
            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="order-xl-1 order-2 col-xl-3 col-12">
                    <!-- SIDEBAR -->
                    <div class="left-sidebar">
                        @include('includes.sidebar')
                    </div>
                    <!-- SIDEBAR END -->
                </div>

                <div class="order-xl-2 order-1 col-xl-9 col-12">
                    <div class="only-pad-mobile">
                        <span id="tour-selection-btn" class="btn type-5 arrow-right text-left flex">
                            <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/filter-dark.svg')}}"
                                 alt="filter-dark">Підбір туру</span>
                        <div class="spacer-xs"></div>
                    </div>
                    <!-- TESTIMONIALS CONTENT -->
                    <h1 class="h1 title">{{!empty($pageContent->seo_title) ? $pageContent->seo_title : $pageContent->title}}</h1>
                    <div class="spacer-xs"></div>
                    <x-page.social-share/>
                    <div class="spacer-xs"></div>

                    <div class="text text-md">
                        {!! $pageContent->text !!}
                    </div>
                    <div class="spacer-xs"></div>

                    <div v-is="'testimonial-list'" url="{{route('testimonials.index')}}"></div>
                    <!-- TESTIMONIALS CONTENT END -->
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>

        <!-- SEO TEXT -->
        <x-page.regulations/>
        <!-- SEO TEXT END -->
    </main>

@endsection


@push('after-popups')
    <div v-is="'testimonial-popup-form'"
         :user='@json(current_user())'
         action='{{route('testimonials.store')}}'
         :data-parent="0"
    >
        @csrf
    </div>

@endpush