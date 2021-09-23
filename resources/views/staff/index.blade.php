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
                            @foreach ($staff as $staff_item)
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="img img-border img-caption style-2">
                                        <div class="top-part text-center">
                                            <span
                                                class="h3 light text-bold">{!! $staff_item->types->implode('title', '<br>') !!}</span>
                                        </div>
                                        <div class="zoom centered">
                                            <img src="{{asset('img/preloader.png')}}"
                                                 data-img-src="{{ $staff_item->avatar ?? asset('img/no-image.png') }}"
                                                 alt="{{$staff_item->first_name}} {{$staff_item->last_name}}">
                                            <a href="{{ route('office-worker', ['id'=>$staff_item->id])}}"
                                               class="full-size"></a>
                                        </div>
                                        <div class="img-caption-info">
                                            <div class="guide-name">
											<span class="h3">
												<a href="{{ route('office-worker', ['id'=>$staff_item->id])}}">{{$staff_item->first_name}} {{$staff_item->last_name}}</a>
											</span>
                                                <span class="text">{{$staff_item->position}}</span>
                                            </div>
                                            <hr>
                                            <div class="contact">
                                                <a href="tel:{{$staff_item->phone}}">{{$staff_item->phone}}</a>
                                                <br>
                                            </div>

                                            <div class="contact">
                                                <a href="mailto:{{$staff_item->email}}">{{$staff_item->email}}</a>
                                            </div>

                                            <div class="contact">
                                                @if ( !empty($staff_item->skype))
                                                    <div class="img">
                                                        <img src="{{asset('img/preloader.png')}}"
                                                             data-img-src="{{asset('icon/skype.svg')}}"
                                                             alt="{{$staff_item->skype}}">
                                                    </div>
                                                    <a href="skype:{{$staff_item->skype}}?call">{{$staff_item->skype}}</a>
                                                @endIf
                                            </div>
                                            <div class="contact">
                                                @if ( !empty($staff_item->viber))
                                                    <div class="img">
                                                        <img src="{{asset('img/preloader.png')}}"
                                                             data-img-src="{{ asset('icon/viber.svg') }}"
                                                             alt="{{$staff_item->viber}}">
                                                    </div>
                                                    <a href="viber:{{$staff_item->viber}}">{{$staff_item->viber}}</a>
                                                @endIf
                                            </div>

                                            <div class="contact">
                                                @if ( !empty($staff_item->whatsapp))
                                                    <div class="img">
                                                        <img src="{{asset('img/preloader.png')}}"
                                                             data-img-src="{{asset('icon/whatsapp.svg')}}"
                                                             alt="{{$staff_item->whatsapp}}">
                                                    </div>
                                                    <a href="whatsapp:{{$staff_item->whatsapp}}">{{$staff_item->whatsapp}}</a>
                                                @endIf
                                            </div>

                                            <div class="contact">
                                                @if ( !empty($staff_item->telegram))
                                                    <div class="img">
                                                        <img src="{{asset('img/preloader.png')}}"
                                                             data-img-src="{{asset('icon/telegram.svg')}}"
                                                             alt="{{$staff_item->telegram}}">
                                                    </div>
                                                    <a href="telegram:{{$staff_item->telegram}}">{{$staff_item->telegram}}</a>
                                                @endIf
                                            </div>
                                            <div class="spacer-xs"></div>
                                            <a href="{{ route('office-worker', ['id'=>$staff_item->id])}}"
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
