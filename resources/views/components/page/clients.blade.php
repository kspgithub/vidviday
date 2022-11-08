@if($clients->count() > 0)
    <section class="partners-slider section">
        <div class="container">
            <hr class="only-desktop">
            <div class="spacer spacer-xs only-desktop"></div>
            <h2 class="title h1 text-center">{{__('Our Clients')}}</h2>
            <div class="spacer-xs"></div>
            <div class="swiper-entry">
                <div class="swiper-container" data-options='{
                        "loop": {{ count($clients) > 1 ? 'true' : 'false' }},
						"lazy": true,
						"speed": 700,
						"autoHeight": true,
						"slidesPerView": 2,
						"slidesPerGroup": 2,
						"spaceBetween": 30,
						"breakpoints": {
							"576": {
								"slidesPerView": 3,
								"slidesPerGroup": 3
							},
							"768": {
								"slidesPerView": 4,
								"slidesPerGroup": 4
							},
							"1400": {
								"slidesPerView": 5,
								"slidesPerGroup": 5
							},
							"1800": {
								"slidesPerView": 6,
								"slidesPerGroup": 6
							}
						}
					}'>
                    <div class="swiper-wrapper">
                        @foreach($clients as $client)
                            <div class="swiper-slide">
                                <div class="partner-item">
                                    <img loading="lazy"
                                         src="{{$client->image_url}}"
                                         width="{{$client->dimensions['thumb']['width']}}"
                                         height="{{$client->dimensions['thumb']['height']}}"
                                         alt="{{$client->title}}" class="swiper-lazy">
                                    <div class="swiper-lazy-preloader"></div>
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
@endif
