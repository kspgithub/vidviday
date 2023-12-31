<div class="section">
    <h2 class="h2">@lang('tours-section.event-tours-title')</h2>
    <div class="spacer-xs"></div>
    <div class="thumbs-carousel swiper-entry">
        <div class="swiper-button-prev bottom">
            <i></i>
        </div>
        <div class="swiper-button-next bottom">
            <i></i>
        </div>
        <div class="swiper-container" data-options='{
								"loop": {{ count($tours) > 1 ? 'true' : 'false' }},
								"lazy": true,
								"speed": 900,
								"slidesPerView": 1,
								"spaceBetween": 20,
								"breakpoints": {
									"1200": {
										"slidesPerView": 3
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
                @foreach($tours as $tour)
                    <div class="swiper-slide">
                        <x-tour.card :tour="$tour" :vue="true"></x-tour.card>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
