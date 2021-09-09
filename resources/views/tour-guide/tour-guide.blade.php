@extends('layout.app')
@section('title', !empty($tourGuides->seo_title) ? $tourGuides->seo_title : $tourGuides->title)
@section('seo_description', !empty($tourGuides->seo_description) ? $tourGuides->seo_description : $tourGuides->title)
@section('seo_keywords', !empty($tourGuides->seo_keywords) ? $tourGuides->seo_keywords : $tourGuides->title)
@section('content')
    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->
            <div class="bread-crumbs">
                <a href="{{('/')}}">Головна</a>
                <span>—</span>
                <a href="{{route('guides')}}">Екскурсоводи</a>
                <span>—</span>
                <span>{{$tourGuides->first_name}} {{$tourGuides->last_name}}</span>
            </div>
            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="order-xl-1 order-2 col-xl-3 col-12">
                    <!-- SIDEBAR -->
                @include('includes.sidebar')
                <!-- SIDEBAR END -->
                </div>

                <div class="order-xl-2 order-1 col-xl-9 col-12">
                    <!-- BANNER/INFO -->
                    <div class="section">
                        @include('tour-guide.includes.banner-guide')

                        <div class="spacer-xs"></div>
                        <h1 class="h1 title">{{$tourGuides->first_name}} {{$tourGuides->last_name}}</h1>
                        <div class="spacer-xs"></div>
                        <div class="text">
                            <p>{{$tourGuides->position}}</p>
                        </div>

                        <div class="row align-items-center">


                            <div class="col">
                                @include('tour-guide.includes.social-share')
                            </div>
                        </div>

                        <div class="text text-md">
                            <p>{{$tourGuides->text}}</p>
                        </div>
                        <div class="spacer-xs"></div>
                    </div>
                    <!-- BANNER/INFO END -->

                    <!-- ACCORDIONS CONTENT -->
                    <div class="accordion type-4">
                        <hr>
                        @include('tour-guide.includes.response')
                        <div class="spacer-sm"></div>
                    </div>
                    <!-- ACCORDIONS CONTENT END -->

                    <!-- THUMBS CAROUSEL -->
                    <div class="section">
                        <h2 class="h2">Тури, які організовує {{$tourGuides->first_name}} {{$tourGuides->last_name}}</h2>
                        <div class="spacer-xs"></div>
                        @include('tour-guide.includes.tour-carousel')
                    </div>
                    <!-- THUMBS CAROUSEL END -->
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>
    </main>
@endsection
