@extends('layout.app')
@foreach ($pageContent as $item)
@section('title', !empty($item->seo_title) ? $item->seo_title : $item->title)
@section('seo_description', !empty($item->seo_description) ? $item->seo_description : $item->title)
@section('seo_keywords', !empty($item->seo_keywords) ? $item->seo_keywords : $item->title)
@endforeach
@section('content')
    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->
            <div class="bread-crumbs">
                <a href="{{('/')}}">Головна</a>
                <span>—</span>
                <span>Екскурсоводи</span>
            </div>
            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="order-xl-1 order-2 col-xl-3 col-12">
                    <!-- SIDEBAR -->
                @include('includes.sidebar')
                <!-- SIDEBAR END -->
                </div>

                <div class="order-xl-2 order-1 col-xl-9 col-12">
                    @include('tour-guide.includes.banner')
                    <div class="section">
                        <div class="thumb-wrap row">
                            @foreach ($tourGuides as $tourGuide)
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="img img-border img-caption style-2">
                                        <div class="zoom centered">
                                            <img src="{{asset('img/preloader.png')}}"
                                                 data-img-src="{{ $tourGuide->image ?? asset('img/no-image.png') }}"
                                                 alt="{{$tourGuide->first_name}} {{$tourGuide->last_name}}">
                                            <a href="{{ route('guides', $tourGuide->slug)}}" class="full-size"></a>
                                        </div>
                                        <div class="img-caption-info">
                                            <div class="guide-name">
											<span class="h3">
												<a href="{{ route('guides', $tourGuide->slug)}}">{{$tourGuide->first_name}} {{$tourGuide->last_name}}</a>
											</span>
                                                <span class="text">14 відгуків</span>
                                            </div>
                                            <span class="text">Проводить <b>20 турів</b></span>

                                            <a href="{{ route('tour-guide', $tourGuide->slug)}}"
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
    @include('tour-guide.includes.seo-text')
    <!-- SEO TEXT END -->
    </main>

@endsection
