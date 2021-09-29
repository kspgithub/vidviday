@extends('layout.app')
@section('title', !empty($pageContent->seo_title) ? $pageContent->seo_title : $pageContent->title)
@section('seo_description', !empty($pageContent->seo_description) ? $pageContent->seo_description : $pageContent->title)
@section('seo_keywords', !empty($pageContent->seo_keywords) ? $pageContent->seo_keywords : $pageContent->title)
@section('content')
<main>
    <div class="container">
        <!-- BREAD CRUMBS -->
        <div class="bread-crumbs">
            <a href="{{('/')}}">Головна</a>
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
                        @include('staff.includes.social-share')
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
                    <div class="accordion-all-expand">
                        <div class="expand-all-button">
                            <div class="expand-all open">Розгорнути все</div>
                            <div class="expand-all close">Згорнути все</div>
                        </div>
                        <div class="accordion type-5">
                            @foreach ($faqItems as $item)
                                <div class="accordion-item">
                                    <div class="accordion-title">
                                        <b>{{ $loop->iteration > 9 ? $loop->iteration : "0".$loop->iteration }}
                                            .</b>
                                        {{ $item->question }}<i></i>
                                    </div>
                                    <div class="accordion-inner"
                                        {!! $loop->iteration == 1 ? 'style="display: block;"' : '' !!}>
                                        <div class="text text-md">
                                            <p> {{ $item->answer }} </p>
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
                <a class="btn font-lg type-1 btn-block btn-book-size  only-pad-mobile"
                   href="{{route('order.corporate')}}">Замовити корпоратив</a>
            </div>
            <div class="col-xl-4 col-12">
                <!-- THUMBS CAROUSEL -->
                <div class="section only-pad-mobile">
                @include('corporate.includes.carousel')
                <!-- THUMBS CAROUSEL END -->
                </div>
                @include('page.includes.right-sidebar', ['button'=>['title'=>'Замовити корпоратив', 'url'=>route('order.corporate')], 'pageContent'=>$pageContent])
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
    @include('home.includes.partners')
    <!-- OUR CLIENTS END -->

    <!-- SEO TEXT -->
    @include('home.includes.seo-text')
    <!-- SEO TEXT END -->
</main>
@endsection
