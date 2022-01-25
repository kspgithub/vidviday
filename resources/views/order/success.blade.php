@extends('layout.app')
@section('title', 'Замовлення туру')
@section('content')
    <main class="order-page">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-12">
                    <!-- SIDEBAR -->
                    <div class="left-sidebar">
                        <div class="left-sidebar-inner">
                            <x-sidebar.filter/>
                        </div>
                    </div>
                    <!-- SIDEBAR END -->
                </div>

                <div class="col-xl-9 col-12">
                    <div class="only-pad-mobile">
                        <span id="tour-selection-btn" class="btn type-5 arrow-right text-left flex"><img
                                src="/img/preloader.png" data-img-src="/icon/filter-dark.svg" alt="filter-dark">Підбір туру</span>
                    </div>
                    <div class="spacer-xs"></div>
                    <!-- ORDER COMPLETE CONTENT -->
                    <div class="row">
                        <div class="col-xl-8 offset-xl-2 col-12">
                            <div class="img done">
                                <img src="/img/preloader.png" data-img-src="/icon/done.svg" alt="done">
                            </div>
                            <div class="spacer-xs"></div>
                            <h1 class="h2 text-center">Ми отримали Ваше замовлення</h1>
                            <div class="text text-center">
                                <p>
                                    @switch($order->confirmation_type)
                                        @case(1)
                                        Ми відповімо електронною поштою впродовж 1 робочого дня
                                        @break
                                        @case(3)
                                        Ми зателефонуємо впродовж 1 робочого дня
                                        @break
                                        @default
                                        Ми відповімо впродовж 1 робочого дня
                                        @break
                                    @endswitch
                                </p>
                            </div>
                            <div class="spacer-xs"></div>
                            <div class="bordered-box">
                                @if($order->tour_id > 0)
                                    <div class="row">
                                        <div class="col-sm-6 col-12">
                                            <span class="text">Назва туру</span>
                                        </div>

                                        <div class="col-sm-6 col-12">
                                            <span class="text"><b>{{$order->tour->title}}</b></span>
                                        </div>
                                    </div>
                                    <hr>
                                @endif
                                @if($order->start_date ?? false)
                                    <div class="row">
                                        <div class="col-sm-6 col-12">
                                            <span class="text">Дата виїзду</span>
                                        </div>

                                        <div class="col-sm-6 col-12">
                                            <span class="text"><b>{{$order->start_title}}</b></span>
                                        </div>
                                    </div>
                                    <hr>
                                @endif
                                @if($order->duration > 0)
                                    <div class="row">
                                        <div class="col-sm-6 col-12">
                                            <span class="text">Тривалість</span>
                                        </div>

                                        <div class="col-sm-6 col-12">
                                            <span class="text">
                                                <b>{{$order->duration.' '.plural_form($order->duration, ['день', 'дні', 'днів'])}}</b>
                                            </span>
                                        </div>
                                    </div>
                                    <hr>
                                @endif
                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <span class="text">Кількість учасників</span>
                                    </div>

                                    <div class="col-sm-6 col-12">
                                        <span class="text"><b>{{$order->places}}</b></span>
                                    </div>
                                </div>
                                <hr>
                                @if($order->children)
                                    <div class="row">
                                        <div class="col-sm-6 col-12">
                                            <span class="text">Діти</span>
                                        </div>

                                        <div class="col-sm-6 col-12">
                                            <span class="text"><b>{{$order->total_children}}</b></span>
                                        </div>
                                    </div>
                                    <hr>
                                @endif
                                @if($order->price > 0)
                                    <div class="row">
                                        <div class="col-sm-6 col-12">
                                            <span class="text">Вартість туру</span>
                                        </div>

                                        <div class="col-sm-6 col-12">
                                            <span
                                                class="text"><b>{{number_format($order->price)}}  {{currency_title($order->currency)}}</b></span>
                                        </div>
                                    </div>
                                    <hr>
                                @endif
                                @if($order->is_tour_agent && $order->commission > 0)
                                    <div class="row">
                                        <div class="col-sm-6 col-12">
                                            <span class="text">Комісія турагенту</span>
                                        </div>

                                        <div class="col-sm-6 col-12">
                                        <span
                                            class="text"><b>{{number_format($order->commission)}}  {{currency_title($order->currency)}}</b></span>
                                        </div>
                                    </div>
                                    <hr>
                                @endif
                                @if($order->offer_date)
                                    <div class="row">
                                        <div class="col-sm-6 col-12">
                                            <span class="text">До якої дати надіслати пропозицію</span>
                                        </div>

                                        <div class="col-sm-6 col-12">
                                            <span class="text"><b>{{date_title($order->offer_date)}}</b></span>
                                        </div>
                                    </div>
                                    <hr>
                                @endif
                                @if($order->discounts)
                                    @foreach($order->discounts as $discount)
                                        <div class="row">
                                            <div class="col-sm-6 col-12">
                                                <span class="text">{{$discount['title']}}</span>
                                            </div>

                                            <div class="col-sm-6 col-12">
                                                <span class="text">
                                                    <b>-{{number_format($discount['value'])}} {{currency_title($order->currency)}}</b>
                                                </span>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                @endif
                                @if($order->total_price > 0)
                                    <div class="row">
                                        <div class="col-sm-6 col-12">
                                            <span class="text">Кінцева вартість</span>
                                        </div>

                                        <div class="col-sm-6 col-12">
                                            <span
                                                class="text"><b>{{number_format($order->total_price)}}  {{currency_title($order->currency)}}</b></span>
                                        </div>
                                    </div>
                                    <hr>
                                @endif
                                @if($order->confirmation_type > 0)
                                    <div class="row">
                                        <div class="col-sm-6 col-12">
                                            <span class="text">Спосіб підтвердження</span>
                                        </div>

                                        <div class="col-sm-6 col-12">
                                            <span class="text"><b>{{$order->confirmation_title}}</b></span>
                                        </div>
                                    </div>
                                    <hr>
                                @endif
                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <span class="text">Номер замовлення</span>
                                    </div>

                                    <div class="col-sm-6 col-12">
                                        <span class="text"><b>{{$order->order_number}}</b></span>
                                    </div>
                                </div>
                            </div>
                            <div class="spacer-xs"></div>
                            <div class="text-center">
                                <span class="text">Дякуємо, що обрали нас!</span>
                                <div class="spacer-xs"></div>
                                <a href="/" class="btn type-1">На головну</a>
                            </div>
                        </div>
                    </div>
                    <!-- ORDER COMPLETE CONTENT END -->
                    <div class="spacer-lg"></div>
                    <hr>
                    <div class="spacer-sm"></div>
                    <!-- THUMBS CAROUSEL -->
                    <x-tour.popular/>
                    <!-- THUMBS CAROUSEL END -->
                </div>
            </div>
            <div class="spacer-md"></div>
        </div>
    </main>

@endsection
