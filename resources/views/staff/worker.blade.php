@extends('layout.app')
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
					<!-- BANNER/INFO -->
					<div class="section">
						<!-- BANNER TABS -->
						<div class="banner-tabs tabs">
							<div class="tabs-nav">
								<span class="tab-title"></span>
								<ul class="tab-toggle">
									<li class="tab-caption active"><img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/photo.svg')}}" alt="placeholder light">Фото</li>

									<li class="tab-caption"><img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/video.svg')}}" alt="video">Відео</li>
								</ul>
							</div>
							<div class="tabs-wrap">
								<!-- TAB #1 -->
								<div class="tab active">
                                    @include('staff.includes.banner')
								</div>
								<!-- TAB #1 END -->

								<!-- TAB #2 -->
								<div class="tab">
									<div class="video" data-frame-src="https://www.youtube.com/embed/BMQQQynlrn4"></div>
								</div>
								<!-- TAB #2 END -->
							</div>
						</div>
						<!-- BANNER TABS END -->
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
													<div class="img">
														<img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/skype.svg')}}" alt="skype">
													</div>
													<a href="skype:{{$staff->skype}}">{{$staff->skype}}</a>
												</div>

												<div class="contact">
													<div class="img">
														<img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/viber.svg')}}" alt="viber">
													</div>
													<a href="viber:+380935115622">+38 (093) 511 56 22</a>
												</div>

												<div class="contact">
													<div class="img">
														<img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/whatsapp.svg')}}" alt="whatsapp">
													</div>
													<a href="#">+38 (093) 511 56 22</a>
												</div>

												<div class="contact">
													<div class="img">
														<img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/telegram.svg')}}" alt="telegram">
													</div>
													<a href="#">@vidviday</a>
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
