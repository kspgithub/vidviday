@extends('layout.app')
@foreach ($pageContent as $item)
@section('title', !empty($item->seo_title) ? $item->seo_title : $item->title)
@section('seo_description', !empty($item->seo_description) ? $item->seo_description : $item->title)
@section('seo_keywords', !empty($item->seo_keywords) ? $item->seo_keywords : $item->title)
@section('content')
<main>
    <div class="container">
        <!-- BREAD CRUMBS -->
        <div class="bread-crumbs">
            <a href="{{('/')}}">Головна</a>
            <span>—</span>
            <span>{{$item->title}}</span>
        </div>
@endforeach
        <!-- BREAD CRUMBS END -->
        <div class="row">
            <div class="col-xl-8 col-12">
                @include('corporate.includes.banner')
                <div class="spacer-xs"></div>
                <!-- CORPORATE CONTENT -->
                <div class="tour-content">
                @foreach ($pageContent as $pageContent)
                    <h1 class="h1 title autoheight">{{$pageContent->seo_h1 ?? $pageContent->title}}</h1>
                    <div class="spacer-xs"></div>
                    <div class="only-pad-mobile">
                @include('corporate.includes.social-share')
                    </div>
                    <div class="text text-md">
                        <p>{!! $pageContent->text !!}</p>
                    </div>
                @endforeach
                    <div class="spacer-xs"></div>
                    <div class="only-pad-mobile">
                        <span class="btn type-1 btn-block btn-book-size open-popup calendar-init" data-rel="calendar-popup">Замовити корпоратив</span>
                        <div class="spacer-xs"></div>
                    </div>
                    <!-- ACCORDIONS CONTENT -->
                    <div class="accordion-all-expand">
                        <div class="expand-all-button">
                            <div class="expand-all open">Розгорнути все</div>
                            <div class="expand-all close">Згорнути все</div>
                        </div>
                        <div class="accordion type-5">
                            @foreach ($faqItems as $faqItem)
                            <div class="accordion-item">
                                <div class="accordion-title"><b>{{$faqItem->id}}.</b>{{$faqItem->question}}<i></i></div>
                                <div class="accordion-inner">
                                    <div class="text text-md">
                                        <p>{{$faqItem->answer}}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="expand-all-button">
                            <div class="expand-all open">Розгорнути все</div>
                            <div class="expand-all close">Згорнути все</div>
                        </div>
                    </div>
                    <!-- ACCORDIONS CONTENT END -->
                </div>
                <!-- CORPORATE CONTENT END -->
                <div class="spacer-xs only-pad-mobile"></div>
                <span class="btn font-lg type-1 btn-block btn-book-size open-popup calendar-init only-pad-mobile" data-rel="calendar-popup">Замовити корпоратив</span>
            </div>

            <div class="col-xl-4 col-12">
                @include('corporate.includes.carousel')
                @include('corporate.includes.right-sidebar')
            </div>
        </div>
        <div class="spacer-lg"></div>
    </div>

    <!-- THUMBS CAROUSEL -->
    @include('corporate.includes.popular')
    <!-- THUMBS CAROUSEL END -->

    <!-- OUR CLIENTS -->
    @include('corporate.includes.clients')
    <!-- OUR CLIENTS END -->

    <!-- SEO TEXT -->
    @include('corporate.includes.seo-text')
    <!-- SEO TEXT END -->
</main>
@endsection
