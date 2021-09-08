@if($slides->count() > 0)
    <div class="swiper-entry">
        <div class="swiper-button-prev">
            <i></i>
        </div>
        <div class="swiper-button-next">
            <i></i>
        </div>
        <div class="swiper-container"
             data-options='{"loop": true, "lazy": true, "slidesPerView": 3, "spaceBetween": 15, "breakpoints": {"992": {"slidesPerView": 4, "spaceBetween": 22}}}'>
            <div class="swiper-wrapper lightbox-wrap">
                @foreach($slides as $slide)
                    <div class="swiper-slide">
                        <div class="img zoom">
                            <img src="{{$slide->getFullUrl()}}"
                                 alt="{{$slide->getCustomProperty('alt')}}"
                                 title="{{$slide->getCustomProperty('title')}}">
                            <div class="full-size open-popup" data-rel="gallery-popup"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="only-mobile swiper-pagination"></div>
    </div>
    <div class="spacer-xs"></div>
@endif
