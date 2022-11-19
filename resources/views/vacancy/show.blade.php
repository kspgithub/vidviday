@extends('layout.app')
@section('title', !empty($vacancy->seo_title) ? $vacancy->seo_title : $vacancy->title)
@section('seo_description', !empty($vacancy->seo_description) ? $vacancy->seo_description : $vacancy->title)
@section('seo_keywords', !empty($vacancy->seo_keywords) ? $vacancy->seo_keywords : $vacancy->title)

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
                    <a href="{{ $pageContent->url }}" itemprop="url">
                        <span itemprop="title">{{ __("Vacancies") }}</span>
                    </a>
                </li>
                <li>
                    <span>—</span>
                </li>
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                    <span itemprop="title">{{ $vacancy->title }}</span>
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
                    <h1 class="h1 title">{{!empty($vacancy->seo_h1) ? $vacancy->seo_h1 : $vacancy->title }}</h1>
                    <div class="spacer-xxs"></div>
                    <span class="text-md">{{$vacancy->created_at?->format('d.m.Y')}}</span>
                    <div class="only-pad-mobile">
                        <x-page.social-share :share-url="route('vacancy.show', $vacancy)" :share-title="$vacancy->title"/>
                    </div>
                    <div class="spacer-xs"></div>
                    <div class="text text-md">
                        {!! $vacancy->short_text !!}
                    </div>

                    {{--CV--}}
                    <div class="only-pad-mobile">
                        <div class="spacer-xs"></div>
                        <a href="#vacancy-form" class="btn type-1 btn-block">{{ __('common.vacancy.send-resume') }}</a>
                    </div>

                    <div class="spacer-xs"></div>
                    <div class="text text-md">
                        {!! $vacancy->text !!}
                    </div>

                    <div class="spacer-xs"></div>

                    <x-page.contact-block :staff="$vacancy->staff" title="Контактна особа"/>

                    <!-- CAREER CONTENT END -->
                </div>

                <div class="col-xl-4 col-12">
                    <!-- SIDEBAR -->
                    <x-page.right-sidebar :pageContent="$pageContent" :share-url="route('vacancy.show', $vacancy->slug)">
                        <div class="sidebar-item" id="vacancy-form" v-is="'vacancy-form'"
                             form-title="{{ __('common.vacancy.form-title-single') }}"
                             form-sub-title="{{ __('common.vacancy.form-sub-title-single') }}"
                        ></div>
                    </x-page.right-sidebar>
                    <!-- SIDEBAR END -->
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>

        <!-- VACANCY SLIDER -->
    @include('vacancy.includes.similar')
    <!-- VACANCY SLIDER END -->

        <!-- SEO TEXT -->
        <x-page.regulations :model="$pageContent"/>
        <!-- SEO TEXT END -->
    </main>

@endsection
