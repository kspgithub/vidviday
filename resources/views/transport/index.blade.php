@extends('layout.app')
@section('content')
    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->
            <div class="bread-crumbs">
                <a href="{{ '/' }}">Головна</a>
                <span>—</span>
                <span>Транспорт</span>
            </div>
            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="col-xl-8 col-12">
                    <!-- BANNER TABS -->
                @include('transport.includes.banner')
                <!-- BANNER TABS END -->
                    <div class="spacer-xs"></div>
                    <!-- TRANSPORT CONTENT -->
                    @foreach ($transports as $transport)
                        <div class="tour-content nn">
                            <h1 class="h1 title">{{$transport->title}}</h1>
                            <div class="spacer-xs only-desktop-9"></div>
                            <div class="only-pad-mobile">
                                @include('staff.includes.social-share')
                                <div class="spacer-xs"></div>
                                <span class="btn type-1 btn-block">Замовити автобус</span>
                                <div class="spacer-xs"></div>
                            </div>
                            {!!$transport->text!!}
                            @include('transport.includes.media')
                            @include('transport.includes.mobile-swiper')
                            <div class="spacer-xs"></div>
                            <h3 class="h3">Співпраця з перевізниками, Вероніка Патек:</h3>
                            <div class="spacer-xs"></div>
                            <div class="contact">
                                <div class="img">
                                    <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('icon/mail.svg')}}"
                                         alt="mail">
                                </div>
                                <a href="mailto:vidviday.transport@gmail.com">vidviday.transport@gmail.com</a>
                            </div>

                            <div class="contact">
                                <div class="img">
                                    <img src="{{asset('/img/preloader.png')}}"
                                         data-img-src="{{asset('icon/smartphone.svg')}}" alt="smartphone">
                                </div>
                                <a href="tel:+380668259937">+38 (066) 825 99 37</a>
                            </div>

                            <div class="contact">
                                <div class="img">
                                    <img src="{{asset('/img/preloader.png')}}"
                                         data-img-src="{{asset('icon/viber.svg')}}" alt="viber">
                                </div>
                                <a title="Встановіть Viber для ПК" href="viber://chat?number=+380935115622">+38 (093)
                                    511 56 22</a>
                            </div>
                            <div class="spacer-sm"></div>
                            @include('transport.includes.form')
                        </div>
                @endforeach
                <!-- TRANSPORT CONTENT END -->
                </div>

                <div class="col-xl-4 col-12">
                    <!-- SIDEBAR -->
                @include('transport.includes.right-sidebar')
                <!-- SIDEBAR END -->
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>

        <!-- SEO TEXT -->
        @include('home.includes.seo-text')
    <!-- SEO TEXT END -->
    </main>

@endsection
