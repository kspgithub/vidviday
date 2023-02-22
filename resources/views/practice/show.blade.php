@extends('layout.app')
@section('title', !empty($practice->seo_title) ? $practice->seo_title : $practice->title)
@section('seo_description', !empty($practice->seo_description) ? $practice->seo_description : $practice->title)
@section('seo_keywords', !empty($practice->seo_keywords) ? $practice->seo_keywords : $practice->title)

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
                        <span itemprop="name">{{ __("Practices") }}</span>
                    </a>
                    <meta itemprop="position" content="2" />
                </li>
                <li>
                    <span>—</span>
                </li>
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name">{{ $practice->title }}</span>
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
                    <h1 class="h1 title">{{!empty($practice->seo_h1) ? $practice->seo_h1 : $practice->title }}</h1>
                    <div class="spacer-xxs"></div>
                    <span class="text-md">{{$practice->created_at?->format('d.m.Y')}}</span>
                    <div class="only-pad-mobile">
                        <x-page.social-share :share-url="route('practice.show', $practice)" :share-title="$practice->title"/>
                    </div>
                    <div class="spacer-xs"></div>
                    <div class="text text-md">
                        {!! $practice->short_text !!}
                    </div>

                    {{--CV--}}
                    <div class="only-pad-mobile">
                        <div class="spacer-xs"></div>
                        <x-seo-button key="vacancy.send" href="#vacancy-form" class="btn type-1 btn-block">{{ __('common.vacancy.send-resume') }}</x-seo-button>
                    </div>

                    <div class="spacer-xs"></div>
                    <div class="text text-md">
                        {!! $practice->text !!}
                    </div>

                    <div class="spacer-xs"></div>

                    <x-page.contact-block :staff="$practice->staff" title="Контактна особа"/>

                    <!-- CAREER CONTENT END -->
                </div>

                <div class="col-xl-4 col-12">
                    <!-- SIDEBAR -->
                    <x-page.right-sidebar :pageContent="$pageContent">
                        <div class="sidebar-item" v-is="'vacancy-form'"
                             form-title="{{ __('common.vacancy.form-title-single') }}"
                             form-sub-title="{{ __('common.vacancy.form-sub-title-single') }}"
                        ></div>
                    </x-page.right-sidebar>
                    <!-- SIDEBAR END -->
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>

        <!-- PRACTICE SLIDER -->
    @include('practice.includes.similar')
    <!-- PRACTICE SLIDER END -->

        <!-- SEO TEXT -->
        <x-page.regulations :model="$pageContent"/>
        <!-- SEO TEXT END -->
    </main>

@endsection
