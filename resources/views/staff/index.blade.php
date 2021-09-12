@extends('layout.app')
@section('title', !empty($pageContent->seo_title) ? $pageContent->seo_title : $pageContent->title)
@section('seo_description', !empty($pageContent->seo_description) ? $pageContent->seo_description : $pageContent->title)
@section('seo_keywords', !empty($pageContent->seo_keywords) ? $pageContent->seo_keywords : $pageContent->title)
@section('content')
    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->
            <div class="bread-crumbs">
                <a href="{{url('/')}}">Головна</a>
                <span>—</span>
                <span>Офісні працівники</span>
            </div>
            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="order-xl-1 order-2 col-xl-3 col-12">
                    <!-- SIDEBAR -->
                @include('includes.sidebar')
                <!-- SIDEBAR END -->
                </div>

                <div class="order-xl-2 order-1 col-xl-9 col-12">
                    @include('staff.includes.banner')
                    <div class="section">
                        <div class="thumb-wrap row">
                            @foreach ($staff as $staff)
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="img img-border img-caption style-2">
                                        <div class="top-part text-center">
                                            <span
                                                class="h3 light text-bold">{!! $staff->types->implode('title', '<br>') !!}</span>
                                        </div>
                                        <div class="zoom centered">
                                            <img src="{{asset('img/preloader.png')}}"
                                                 data-img-src="{{ $staff->avatar ?? asset('img/no-image.png') }}"
                                                 alt="{{$staff->first_name}} {{$staff->last_name}}">
                                            <a href="{{ route('office-worker', ['id'=>$staff->id])}}"
                                               class="full-size"></a>
                                        </div>
                                        <div class="img-caption-info">
                                            <div class="guide-name">
											<span class="h3">
												<a href="{{ route('office-worker', ['id'=>$staff->id])}}">{{$staff->first_name}} {{$staff->last_name}}</a>
											</span>
                                                <span class="text">{{$staff->position}}</span>
                                            </div>
                                            <hr>
                                            <div class="contact">
                                                <a href="tel:{{$staff->phone}}">{{$staff->phone}}</a>
                                                <br>
                                            </div>

                                            <div class="contact">
                                                <a href="mailto:{{$staff->email}}">{{$staff->email}}</a>
                                            </div>

                                            <div class="contact">
                                                @if ( !empty($staff->skype))
                                                    <div class="img">
                                                        <img src="{{asset('img/preloader.png')}}"
                                                             data-img-src="{{asset('icon/skype.svg')}}"
                                                             alt="{{$staff->skype}}">
                                                    </div>
                                                    <a href="skype:{{$staff->skype}}?call">{{$staff->skype}}</a>
                                                @endIf
                                            </div>
                                            <div class="contact">
                                                @if ( !empty($staff->viber))
                                                    <div class="img">
                                                        <img src="{{asset('img/preloader.png')}}"
                                                             data-img-src="{{ asset('icon/viber.svg') }}"
                                                             alt="{{$staff->viber}}">
                                                    </div>
                                                    <a href="viber:{{$staff->viber}}">{{$staff->viber}}</a>
                                                @endIf
                                            </div>

                                            <div class="contact">
                                                @if ( !empty($staff->whatsapp))
                                                    <div class="img">
                                                        <img src="{{asset('img/preloader.png')}}"
                                                             data-img-src="{{asset('icon/whatsapp.svg')}}"
                                                             alt="{{$staff->whatsapp}}">
                                                    </div>
                                                    <a href="whatsapp:{{$staff->whatsapp}}">{{$staff->whatsapp}}</a>
                                                @endIf
                                            </div>

                                            <div class="contact">
                                                @if ( !empty($staff->telegram))
                                                    <div class="img">
                                                        <img src="{{asset('img/preloader.png')}}"
                                                             data-img-src="{{asset('icon/telegram.svg')}}"
                                                             alt="{{$staff->telegram}}">
                                                    </div>
                                                    <a href="telegram:{{$staff->telegram}}">{{$staff->telegram}}</a>
                                                @endIf
                                            </div>
                                            <div class="spacer-xs"></div>
                                            <a href="{{ route('office-worker', ['id'=>$staff->id])}}"
                                               class="btn type-1 btn-block">Дізнатись більше</a>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- MOBILE BUTTONS BAR -->
                    <div class="only-pad-mobile">
                        <div class="row short-distance">
                            <div class="col-md-4 col-12 only-pad">
                                <span class="btn type-4 arrow-right text-left flex"><img
                                        src="{{asset('img/preloader.png')}}"
                                        data-img-src="{{asset('icon/placeholder-light.svg')}}" alt="placeholder light">Замовити тур</span>
                            </div>

                            <div class="col-md-4 col-12 only-pad">
                                <a href="{{asset('documents/test-document.pdf')}}" download
                                   class="btn type-5 arrow-right text-left flex"><img
                                        src="{{asset('img/preloader.png')}}"
                                        data-img-src="{{asset('icon/tours-scedule-dark.svg')}}"
                                        alt="tours scedule dark">Завантажити розклади турів</a>
                            </div>

                            <div class="col-md-4 col-12">
                                <span id="tour-selection-btn" class="btn type-5 arrow-right text-left flex"><img
                                        src="{{asset('img/preloader.png')}}"
                                        data-img-src="{{asset('icon/filter-dark.svg')}}"
                                        alt="filter-dark">Підбір туру</span>
                            </div>
                        </div>
                        <div class="spacer-sm"></div>
                    </div>
                    <!-- MOBILE BUTTONS BAR END -->
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>

        <!-- SEO TEXT -->
    @include('home.includes.seo-text')
    <!-- SEO TEXT END -->
    </main>

@endsection
