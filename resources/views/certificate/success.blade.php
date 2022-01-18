@extends('layout.app')

@section('title', !empty($pageContent->seo_title) ? $pageContent->seo_title : $pageContent->title)
@section('seo_description', !empty($pageContent->seo_description) ? $pageContent->seo_description : $pageContent->title)
@section('seo_keywords', !empty($pageContent->seo_keywords) ? $pageContent->seo_keywords : $pageContent->title)

@section('content')
    <main class="order-page">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-12">
                    <!-- SIDEBAR -->
                    <div class="left-sidebar">
                        <div class="left-sidebar-inner">
                            <x-sidebar.filter/>

                            <x-sidebar.mailing/>
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
                            <h1 class="h2 text-center">Замовлення сертифікату успішно оформлене</h1>
                            <div class="spacer-xs"></div>
                            <div class="bordered-box">
                                <div class="row">
                                    <div class="col-6">
                                        <span class="text">Тип</span>
                                    </div>

                                    <div class="col-6">
                                        <span class="text">
                                            <b>{{$order->type === 'sum' ? 'На суму' : 'На мандрівку'}}</b>
                                        </span>
                                    </div>
                                </div>
                                <hr>
                                @if($order->type === 'sum')
                                    <div class="row">
                                        <div class="col-6">
                                            <span class="text">Сума</span>
                                        </div>

                                        <div class="col-6">
                                            <span class="text"><b>{{$order->sum}} грн.</b></span>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-6">
                                            <span class="text">Тур</span>
                                        </div>

                                        <div class="col-6">
                                            <span class="text"><b>{{$order->tour->title ?? '-'}}</b></span>
                                        </div>
                                    </div>
                                @endif
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <span class="text">Дизайн</span>
                                    </div>

                                    <div class="col-6">
                                        <span class="text">
                                            <b>{{$order->design === 'heart' ? 'У формі серця' : 'Класичний'}}</b>
                                        </span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <span class="text">Формат</span>
                                    </div>

                                    <div class="col-6">
                                        <span class="text">
                                            <b>{{$order->format === 'printed' ? 'Друкований' : 'Електронний'}}</b>
                                        </span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <span class="text">Номер замовлення</span>
                                    </div>

                                    <div class="col-6">
                                        <span class="text"><b>{{$order->order_number}}</b></span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <span class="text">Данні отримувамча</span>
                                    </div>

                                    <div class="col-6">
                                        <span
                                            class="text"><b>{{$order->last_name_recipient}} {{$order->first_name_recipient}}</b></span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <span class="text">Загальна сума</span>
                                    </div>

                                    <div class="col-6">
                                        <span
                                            class="text"><b>{{number_format($order->price, 0, '', ',')}} грн.</b></span>
                                    </div>
                                </div>
                            </div>
                            <div class="spacer-xs"></div>
                            <div class="text-center">
                                <span
                                    class="text-md">Деталі щодо замовлення надіслані на вашу електронну адресу <b>{{$order->email}}</b></span>
                                <div class="spacer-xs"></div>
                                <a href="{{pageUrlByKey('certificate')}}" class="btn type-1">До опису сертифікату</a>
                            </div>
                        </div>
                    </div>
                    <!-- ORDER COMPLETE CONTENT END -->

                    <div class="spacer-lg"></div>
                    <hr>
                    <div class="spacer-sm"></div>
                    <x-page.social-links/>
                    <div class="spacer-sm"></div>
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

