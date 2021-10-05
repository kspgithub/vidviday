@if($similar_tours->count() > 0)
<section class="section">
    <div class="container">
        <h2 class="h1 title text-center">@lang('tours-section.similar-tours')</h2>
        <div class="spacer-xs"></div>
        <div class="thumbs-carousel swiper-entry">
            <div class="swiper-container" data-options='{
						"loop": true,
						"lazy": true,
						"speed": 900,
						"slidesPerView": 1,
						"spaceBetween": 20,
						"breakpoints": {
							"1200": {
								"slidesPerView": 4
							},
							"992": {
								"slidesPerView": 3
							},
							"768": {
								"slidesPerView": 2
							}
						}
					}'>
                <div class="swiper-wrapper">
                    @foreach($similar_tours as $similar_tour)
                        <div class="swiper-slide">
                            <x-tour.card :tour="$similar_tour" mode="thumb" :vue="true"/>
                        </div>

                    @endforeach
                </div>

            </div>
            <div class="swiper-button-prev bottom-sm">
                <i></i>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next bottom-sm">
                <i></i>
            </div>
        </div>
        <div class="spacer-xs only-tab-mobile"></div>
    </div>
</section>
@endif
