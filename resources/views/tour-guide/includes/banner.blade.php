					<!-- BANNER/INFO -->
					<div class="section">
						<!-- BANNER TABS -->
						<div class="banner-tabs tabs">
							<div class="tabs-nav">
								<span class="tab-title"></span>
								<ul class="tab-toggle">
                                    @if ( !empty($staff->media))
									<li class="tab-caption active"><img src="{{asset('img/preloader.png')}}" data-img-src="icon/photo.svg" alt="placeholder light">Фото</li>
                                    @endif
                                    @if ( !empty($staff->video))
									<li class="tab-caption"><img src="{{asset('img/preloader.png')}}" data-img-src="icon/video.svg" alt="video">Відео</li>
                                    @endif
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
											<div class="swiper-container" data-options='{"autoHeight": true, "parallax": true, "speed": 900}'>
												<div class="swiper-wrapper lightbox-wrap">
													<div class="swiper-slide">
                                                        <img src="{{ $pageContent->media ?? asset('/img/no-image.png') }}"
                                                             alt="{{$pageContent->seo_h1 ?? $pageContent->title}}"
                                                             data-swiper-parallax="30%">
														<a href="{{ $pageContent->media ?? asset('/img/no-image.png') }}" class="lightbox full-size" data-caption="{{$pageContent->seo_h1 ?? $pageContent->title}}">
															<span>{{$pageContent->seo_h1 ?? $pageContent->title}}</span>
														</a>
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
						<div class="spacer-xs"></div>
						<h1 class="h1 title">{{$pageContent->title}}</h1>
						<div class="text text-md">
							<p> {!! $pageContent->text !!}</p>
						</div>
						<div class="spacer-xs"></div>
					</div>
					<!-- BANNER/INFO END -->

