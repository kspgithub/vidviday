@extends('layout.app')
@section('title', !empty($course->seo_title) ? $course->seo_title : $course->title)
@section('seo_description', !empty($course->seo_description) ? $course->seo_description : $course->title)
@section('seo_keywords', !empty($course->seo_keywords) ? $course->seo_keywords : $course->title)

@section('content')
    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->
            <ul class="bread-crumbs" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="{{ route('home') }}" itemprop="item">
                        <span itemprop="name">{{ __("Home") }}</span>
                    </a>
                    <meta itemprop="position" content="1" />
                </li>
                <li>
                    <span>—</span>
                </li>
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="{{ $pageContent->url }}" itemprop="item">
                        <span itemprop="name">{{ __("Courses") }}</span>
                    </a>
                    <meta itemprop="position" content="2" />
                </li>
                <li>
                    <span>—</span>
                </li>
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name">{{ $course->title }}</span>
                    <meta itemprop="position" content="3" />
                </li>
            </ul>
            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="col-xl-8 col-12">
                    <!-- BANNER TABS -->
                @include('page.includes.banner-tabs', [
                   'pictures'=>$pageContent->getMedia(),
                   'video'=>$pageContent->video
               ])
                <!-- BANNER TABS END -->
                    <div class="spacer-xs"></div>
                    <!-- CAREER CONTENT -->
                    <h1 class="h1 title">{{!empty($course->seo_h1) ? $course->seo_h1 : $course->title }}</h1>
                    <div class="spacer-xxs"></div>
                    <span class="text-md">{{$course->created_at?->format('d.m.Y')}}</span>
                    <div class="only-pad-mobile">
                        <x-page.social-share :share-url="route('course.show', $course)" :share-title="$course->title"/>
                    </div>
                    <div class="spacer-xs"></div>
                    <div class="text text-md">
                        {!! $course->short_text !!}
                    </div>

                    {{--CV--}}
                    <div class="only-pad-mobile">
                        <div class="spacer-xs"></div>
                        <a v-bind="$buttons('vacancy.send')" href="#vacancy-form" class="btn type-1 btn-block">{{ __('common.vacancy.send-resume') }}</a>
                    </div>

                    <div class="spacer-xs"></div>
                    <div class="text text-md">
                        {!! $course->text !!}
                    </div>

                    <div class="spacer-xs"></div>

                    <x-page.contact-block :staff="$course->staff" title="Контактна особа"/>

                    <!-- CAREER CONTENT END -->
                </div>

                <div class="col-xl-4 col-12">
                    <!-- SIDEBAR -->
                    <x-page.right-sidebar :pageContent="$pageContent">
                        <div class="sidebar-item" id="vacancy-form" v-is="'vacancy-form'"
                             form-title="{{ __('common.course.form-title-single') }}"
                             form-sub-title="{{ __('common.course.form-sub-title-single') }}"
                        ></div>
                    </x-page.right-sidebar>
                    <!-- SIDEBAR END -->
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>

        <!-- COURSE SLIDER -->
    @include('course.includes.similar')
    <!-- COURSE SLIDER END -->

        <!-- SEO TEXT -->
        <x-page.regulations :model="$pageContent"/>
        <!-- SEO TEXT END -->
    </main>

@endsection
