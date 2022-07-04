<div class="spacer-md"></div>
<h2 class="h1 title text-center">{{__('tours-section.most-popular-corporate')}}</h2>
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
            @foreach($tours as $tour)
                <div class="swiper-slide">
                    <x-tour.card :tour="$tour"/>
                </div>
            @endforeach
        </div>
    </div>
    <div class="swiper-button-prev bottom-sm only-pad-mobile">
        <i></i>
    </div>
    <div class="swiper-pagination"></div>
    <div class="swiper-button-next bottom-sm only-pad-mobile">
        <i></i>
    </div>
</div>
