@extends('layout.app')
@section('title', "$staff->first_name $staff->last_name - $staff->position")
@section('seo_description', "$staff->text")
@section('seo_keywords', "$staff->position")
@section('content')
    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->
            <div class="bread-crumbs">
                <a href="{{('/')}}">Головна</a>
                <span>—</span>
                <a href="{{route('office-workers')}}">Офісні працівники</a>
                <span>—</span>
                <span>{{$staff->first_name}} {{$staff->last_name}}</span>
            </div>
            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="order-xl-1 order-2 col-xl-3 col-12">
                    <!-- SIDEBAR -->
                @include('includes.sidebar')
                <!-- SIDEBAR END -->
                </div>

                <div class="order-xl-2 order-1 col-xl-9 col-12">

                    @include('staff.includes.banner-worker')

                    <div class="spacer-xs"></div>
                    <h1 class="h1 title">{{$staff->first_name}} {{$staff->last_name}}</h1>
                    <div class="spacer-xs"></div>
                    <div class="text">
                        <p>{{$staff->position}}</p>
                    </div>

                    <div class="row align-items-center">


                        <div class="col">
                            @include('staff.includes.social-share')
                        </div>
                    </div>

                    <div class="text text-md">
                        <p>{{$staff->text}}</p>
                    </div>
                    <div class="spacer-xs"></div>
                </div>
                <!-- BANNER/INFO END -->

                <!-- ACCORDIONS CONTENT -->
                <div class="section">
                    <div class="accordion-all-expand">
                        <div class="expand-all-button">
                            <div class="expand-all open">Розгорнути все</div>
                            <div class="expand-all close">Згорнути все</div>
                        </div>
                        <div class="accordion type-4 active">
                            <div class="accordion-item">
                                <div class="accordion-title">Контакти<i></i></div>
                                <div class="accordion-inner" style="display: block;">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-12">
                                            <span class="text-md text-medium">Телефонуйте</span>
                                            <div class="contact">
                                                <a href="tel:{{$staff->phone}}">{{$staff->phone}}</a>
                                                <br>
                                            </div>
                                            <div class="spacer-xs only-mobile"></div>
                                        </div>

                                        <div class="col-lg-4 col-md-6 col-12">
                                            <span class="text-md text-medium">Пишіть</span>
                                            <div class="contact">
                                                <a href="mailto:{{$staff->email}}">{{$staff->email}}</a>
                                            </div>

                                            <div class="contact">
                                                @if ( !empty($staff->skype))
                                                    <div class="img">
                                                        <img src="{{asset('img/preloader.png')}}"
                                                             data-img-src="{{asset('icon/skype.svg')}}" alt="skype">
                                                    </div>
                                                    <a href="skype:{{$staff->skype}}">{{$staff->skype}}</a>
                                                @endIf

                                            </div>

                                            <div class="contact">
                                                @if ( !empty($staff->viber))
                                                    <div class="img">
                                                        <img src="{{asset('img/preloader.png')}}"
                                                             data-img-src="{{asset('icon/viber.svg')}}" alt="viber">
                                                    </div>
                                                    <a href="viber:{{$staff->viber}}">{{$staff->viber}}</a>
                                                @endIf
                                            </div>

                                            <div class="contact">
                                                @if ( !empty($staff->whatsapp))

                                                    <div class="img">
                                                        <img src="{{asset('img/preloader.png')}}"
                                                             data-img-src="{{asset('icon/whatsapp.svg')}}"
                                                             alt="whatsapp">
                                                    </div>
                                                    <a href="{{$staff->whatsapp}}">{{$staff->whatsapp}}</a>
                                            </div>
                                            @endIf
                                            <div class="contact">
                                                @if ( !empty($staff->telegram))
                                                    <div class="img">
                                                        <img src="{{asset('img/preloader.png')}}"
                                                             data-img-src="{{asset('icon/telegram.svg')}}"
                                                             alt="telegram">
                                                    </div>
                                                    <a href="{{$staff->telegram}}">{{$staff->telegram}}</a>
                                                @endIf
                                            </div>
                                        </div>
                                    </div>
                                    <div class="spacer-xs"></div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                @include('staff.includes.response')
                            </div>
                        </div>
                        <div class="expand-all-button">
                            <div class="expand-all open">Розгорнути все</div>
                            <div class="expand-all close">Згорнути все</div>
                        </div>
                    </div>
                    <div class="spacer-sm"></div>
                </div>
                <!-- ACCORDIONS CONTENT END -->

                <!-- THUMBS CAROUSEL -->
                <div class="section">
                    <h2 class="h2">Тури, які організовує {{$staff->first_name}} {{$staff->last_name}}</h2>
                    <div class="spacer-xs"></div>
                    @include('staff.includes.tour-carousel')
                </div>
                <!-- THUMBS CAROUSEL END -->
            </div>
        </div>
        <div class="spacer-lg"></div>
        </div>
    </main>
@endsection
