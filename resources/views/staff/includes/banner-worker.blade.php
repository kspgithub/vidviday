					<!-- BANNER/INFO -->
					<div class="section">
						<!-- BANNER TABS -->
						<div class="banner-tabs tabs">
							<div class="tabs-nav">
								<span class="tab-title"></span>
								<ul class="tab-toggle">
									<li class="tab-caption active"><img src="{{asset('img/preloader.png')}}" data-img-src="icon/photo.svg" alt="placeholder light">Фото</li>

									<li class="tab-caption"><img src="{{asset('img/preloader.png')}}" data-img-src="icon/video.svg" alt="video">Відео</li>
								</ul>
							</div>
							<div class="tabs-wrap">
								<!-- TAB #1 -->
								<div class="tab active">
									<div class="banner-carousel">
										<div class="swiper-entry">
											<div class="swiper-button-prev">
												<i></i>
											</div>
											<div class="swiper-button-next">
												<i></i>
											</div>
											<div class="swiper-container" data-options='{"lazy": true, "autoHeight": true, "parallax": true, "speed": 900}'>
												<div class="swiper-wrapper lightbox-wrap">
													<div class="swiper-slide">
														<img src="{{asset('img/preloader.png')}}" data-src="{{ $staff->avatar ?? asset('img/no-image.png') }}" alt="{{$staff->first_name}} {{$staff->last_name}}" data-swiper-parallax="30%" class="swiper-lazy">
														<div class="swiper-lazy-preloader"></div>
														<div class="full-size">
															<span>{{$staff->first_name}} {{$staff->last_name}}</span>
														</div>
													</div>

													<div class="swiper-slide">
														<img src="{{asset('img/preloader.png')}}" data-src="{{ $staff->avatar ?? asset('img/no-image.png') }}" alt="{{$staff->first_name}} {{$staff->last_name}}" data-swiper-parallax="30%" class="swiper-lazy">
														<div class="swiper-lazy-preloader"></div>
														<div class="full-size">
															<span>{{$staff->first_name}} {{$staff->last_name}}</span>
														</div>
													</div>

													<div class="swiper-slide">
														<img src="{{asset('img/preloader.png')}}" data-src="{{ $staff->avatar ?? asset('img/no-image.png') }}" alt="{{$staff->first_name}} {{$staff->last_name}}" data-swiper-parallax="30%" class="swiper-lazy">
														<div class="swiper-lazy-preloader"></div>
														<div class="full-size">
															<span>{{$staff->first_name}} {{$staff->last_name}}</span>
														</div>
													</div>

													<div class="swiper-slide">
														<img src="{{asset('img/preloader.png')}}" data-src="{{ $staff->avatar ?? asset('img/no-image.png') }}" alt="{{$staff->first_name}} {{$staff->last_name}}" data-swiper-parallax="30%" class="swiper-lazy">
														<div class="swiper-lazy-preloader"></div>
														<div class="full-size">
															<span>{{$staff->first_name}} {{$staff->last_name}}</span>
														</div>
													</div>
												</div>
											</div>
											<div class="swiper-pagination light"></div>
										</div>
									</div>
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
					<!-- BANNER/INFO END -->
