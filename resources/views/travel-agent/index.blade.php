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
                <div class="col-xl-8 col-12">
                    @include('page.includes.banner-tabs', [
                            'pictures'=>$pageContent->getMedia(),
                            'video'=>$pageContent->video
                        ])
                    <div class="spacer-xs"></div>
                    <!-- CORPORATE CONTENT -->
                    <div class="tour-content">
                        <h1 class="h1 title autoheight">{{$pageContent->seo_h1 ?? $pageContent->title}}</h1>
                        <div class="spacer-xs"></div>
                        <div class="only-pad-mobile">
                            <x-page.social-share/>
                        </div>
                        <div class="text text-md">
                            <p>{!! $pageContent->text !!}</p>
                        </div>
                        <div class="spacer-xs"></div>
                        <div class="only-pad-mobile">
                        <span class="btn type-1 btn-block btn-book-size open-popup calendar-init"
                              data-rel="calendar-popup">Замовити корпоратив</span>
                            <div class="spacer-xs"></div>
                        </div>
                        <!-- ACCORDIONS CONTENT -->
                        <x-faq.accordion :items="$faqItems"/>
                        <!-- ACCORDIONS CONTENT END -->
                    </div>
                    <!-- CORPORATE CONTENT END -->
                    <div class="spacer-xs only-pad-mobile"></div>
                    <a class="btn font-lg type-1 btn-block btn-book-size  only-pad-mobile"
                       href="{{route('order.corporate')}}">Замовити корпоратив</a>
                </div>
                <div class="col-xl-4 col-12">
                    <!-- THUMBS CAROUSEL -->
                    <div class="section only-pad-mobile">
                    @include('corporate.includes.carousel')
                    <!-- THUMBS CAROUSEL END -->
                    </div>
                    @include('page.includes.right-sidebar', ['button'=>['title'=>'Почати співпрацю', 'url'=>'#'], 'pageContent'=>$pageContent])
                </div>
            </div>
            <!-- THUMBS CAROUSEL -->
            <div class="section only-desktop only">
                @include('corporate.includes.carousel')
            </div>
            <!-- THUMBS CAROUSEL END -->
            <div class="spacer-lg"></div>
        </div>


        <!-- OUR CLIENTS -->
        <x-page.clients/>
        <!-- OUR CLIENTS END -->

        <!-- SEO TEXT -->
        <x-page.regulations :model="$pageContent"/>
        <!-- SEO TEXT END -->
    </main>
@endsection
