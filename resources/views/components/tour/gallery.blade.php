@props([
    'slides'=>[]
])
<div class="banner-carousel">

    <div class="swiper-entry">
        <div class="swiper-button-prev">
            <i></i>
        </div>
        <div class="swiper-button-next">
            <i></i>
        </div>
        <div class="swiper-container"
             data-options='{"parallax": true, "speed": 900, "lazy": true}'>
            <div class="swiper-wrapper">
                @foreach($slides as $i => $slide)
                    <div class="swiper-slide">
                        <img src="{{asset('/img/preloader.png')}}"
                             data-src="{{$slide->getFullUrl()}}"
                             alt="{{$slide->alt}}" data-swiper-parallax="30%"
                             class="swiper-lazy">
                        <div class="swiper-lazy-preloader"></div>
                        <div class="full-size">
                            <span>{{$slide->title}}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="swiper-pagination light"></div>
    </div>
</div>
