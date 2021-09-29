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
                <span>Наші контакти</span>
            </div>
            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="order-xl-1 order-2 col-xl-3 col-12">
                    <!-- SIDEBAR -->
                @include('includes.sidebar')
                <!-- SIDEBAR END -->
                </div>

                <div class="order-xl-2 order-1 col-xl-9 col-12">
                    <div class="only-pad-mobile">
                        <span id="tour-selection-btn" class="btn type-5 arrow-right text-left flex"><img
                                src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/filter-dark.svg')}}"
                                alt="filter-dark">Підбір туру</span>
                        <div class="spacer-xs"></div>
                    </div>
                    <!-- BANNER/INFO -->
                @include('contact.includes.banner')
                <!-- BANNER/INFO END -->
                    <div class="spacer-xs"></div>
                    <!-- MAP -->
                    <div class="map-route-wrap">
                        <div class="map-block full-size" id="map-canvas-route" data-lat="{{$contact->lat}}"
                             data-lng="{{$contact->lng}}" data-zoom="13"
                             data-set-marker="{{asset('icon/marker-circle.svg')}}"></div>

                        <div class="addresses-block">
                            <a data-lat="{{$contact->lat}}" data-lng="{{$contact->lng}}"
                               data-marker="{{asset('img/marker.png')}}"
                               data-string="<div class='map-informer-content'><p>{{$contact->address}}{{$contact->address_coment}}</p></div>"></a>
                        </div>
                        <form action="/" class="build-route">
                            <label>
                                <!-- <i>Ваше місце розташування</i> -->
                                <input type="text" name="user-location" id="your_location">
                            </label>

                            <label>
                                <input type="text" value="{{$contact->address}}" id="select_department" disabled>
                            </label>
                        </form>
                    </div>
                    <!-- MAP END -->
                    <div class="spacer-xs"></div>
                    <!-- ACCORDIONS CONTENT -->
                    <div class="accordion-all-expand">
                        <div class="expand-all-button">
                            <div class="expand-all open">Розгорнути все</div>
                            <div class="expand-all close">Згорнути все</div>
                        </div>
                        <div class="accordion type-4">
                            <div class="accordion-item active">
                                <div class="accordion-title">Корпоративні замовлення<i></i></div>
                                <div class="accordion-inner" style="display: block;">
                                    <div class="thumb-wrap row">
                                        @foreach ($specialists as $specialist)
                                            <div class="col-lg-4 col-md-6 col-12">
                                                <div class="img img-border img-caption style-2">
                                                    <div class="zoom">
                                                        <img src="{{asset('img/preloader.png')}}"
                                                             data-img-src="{{$specialist->avatar}}"
                                                             alt="{{$specialist->first_name}}{{$specialist->last_name}}">
                                                        <a href="tour-guide.php" class="full-size"></a>
                                                    </div>
                                                    <div class="img-caption-info">
                                                        <div class="guide-name">
														<span class="h3">
															<a href="office-worker.php">{{$specialist->first_name}} {{$specialist->last_name}}</a>
														</span>
                                                            <span
                                                                class="text">{!! $specialist->types->implode('title') !!}</span>
                                                            <br>
                                                            <span class="text">14 відгуків</span>
                                                        </div>
                                                        <hr>
                                                        <div class="contact">
                                                            <a href="tel:{{$specialist->phone}}">{{$specialist->phone}}</a>
                                                            <br>
                                                        </div>

                                                        <div class="contact">
                                                            <a href="mailto:{{$specialist->email}}">{{$specialist->email}}</a>
                                                        </div>

                                                        <div class="contact">
                                                            @if ( !empty($specialist->skype))
                                                                <div class="img">
                                                                    <img src="{{asset('img/preloader.png')}}"
                                                                         data-img-src="{{asset('icon/skype.svg')}}"
                                                                         alt="skype">
                                                                </div>
                                                                <a href="skype:{{$specialist->skype}}?call">{{$specialist->skype}}</a>
                                                            @endif
                                                        </div>
                                                        <div class="spacer-xs"></div>
                                                        <a href="{{ route('office-worker', ['id'=>$specialist->id])}}"
                                                           class="btn type-1 btn-block">Дізнатись більше</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <div class="accordion-title">Співпраця з туристичними агенціями<i></i></div>
                                <div class="accordion-inner">
                                    <div class="thumb-wrap row">
                                        @foreach ($specs as $spec)
                                            <div class="col-lg-4 col-md-6 col-12">
                                                <div class="img img-border img-caption style-2">
                                                    <div class="zoom">
                                                        <img src="{{asset('img/preloader.png')}}"
                                                             data-img-src="{{$spec->avatar}}"
                                                             alt="{{$spec->first_name}}{{$spec->last_name}}">
                                                        <a href="tour-guide.php" class="full-size"></a>
                                                    </div>
                                                    <div class="img-caption-info">
                                                        <div class="guide-name">
                                                        <span class="h3">
                                                            <a href="office-worker.php">{{$spec->first_name}} {{$spec->last_name}}</a>
                                                        </span>
                                                            <span
                                                                class="text">{!! $spec->types->implode('title') !!}</span>
                                                            <br>
                                                            <span class="text">14 відгуків</span>
                                                    </div>
                                                    <hr>
                                                    <div class="contact">
                                                        <a href="tel:{{$spec->phone}}">{{$spec->phone}}</a>
                                                        <br>
                                                    </div>

                                                    <div class="contact">
                                                        <a href="mailto:{{$spec->email}}">{{$spec->email}}</a>
                                                    </div>

                                                    <div class="contact">
                                                        @if ( !empty($spec->skype))
                                                        <div class="img">
                                                            <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/skype.svg')}}" alt="skype">
                                                        </div>
                                                        <a href="skype:{{$spec->skype}}?call">{{$spec->skype}}</a>
                                                        @endif
                                                    </div>
                                                    <div class="spacer-xs"></div>
                                                    <a href="{{ route('office-worker', ['id'=>$spec->id])}}" class="btn type-1 btn-block">Дізнатись більше</a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
									</div>
								</div>
							</div>
						</div>
						<div class="expand-all-button">
							<div class="expand-all open">Розгорнути все</div>
							<div class="expand-all close">Згорнути все</div>
						</div>
					</div>
					<!-- ACCORDIONS CONTENT END -->
				</div>
			</div>
			<div class="spacer-lg"></div>
		</div>
        <!-- SEO TEXT -->
        @include('home.includes.seo-text')
        <!-- SEO TEXT END -->
	</main>
@endsection
