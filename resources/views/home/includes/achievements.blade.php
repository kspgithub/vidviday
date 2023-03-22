<section class="partners-slider section">
    <div class="container">
        <hr class="only-desktop">
        <div class="spacer spacer-xs only-desktop"></div>
        <h2 class="title h1 text-center">@lang('common.achievement')</h2>
        <div class="spacer-xs"></div>
        <div class="swiper-entry">
            <div class="swiper-container" data-options='{
						"loop": {{ count($achievements) > 1 ? 'true' : 'false' }},
						"lazy": true,
						"speed": 700,
						"autoHeight": true,
						"slidesPerView": 2,
						"slidesPerGroup": 2,
						"spaceBetween": 20,
						"breakpoints": {
							"768": {
								"slidesPerView": 3,
								"slidesPerGroup": 3
							},
							"1200": {
								"slidesPerView": 4,
								"slidesPerGroup": 4,
                                "spaceBetween": 0
							}
						}
					}'>
                <div class="swiper-wrapper">
                    @foreach($achievements as $achievement)
                        <div class="swiper-slide">
                            <div class="partner-item">
                                <img loading="lazy" data-src="{{$achievement->image_url}}"
                                     alt="{{$achievement->title}}"
                                     class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                            </div>
                            <div class="text text-bold text-center">
                                {!! $achievement->title !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="swiper-button-prev"><i></i></div>
            <div class="swiper-pagination relative"></div>
            <div class="swiper-button-next"><i></i></div>
        </div>
    </div>
    <div class="spacer spacer-xs"></div>
</section>
