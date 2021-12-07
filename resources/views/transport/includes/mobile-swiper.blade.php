@if($transports->count() > 0)
<div class="only-pad-mobile">
    <div class="swiper-bbutton-prev">
        <i></i>
    </div>
    <div class="swiper-bbutton-next">
        <i></i>
    </div>
    <div class="swiper-entry slider-transport">
        <div class="swiper-container" data-options='{
            "lazy": true,
            "slidesPerView": 1,
            "spaceBetween": 20,
            "breakpoints": {
                "992": {
                    "slidesPerView": 2
                }
            }
        }'>
            <div class="swiper-wrapper">
                @foreach($transports as $transport)
                    <div class="swiper-slide">
                        <div class="img img-border img-caption">
                            <img src="{{asset('/img/preloader.png')}}" data-src="{{$transport->image_url}}"
                                 alt="{{$transport->title}}" class="swiper-lazy">
                            <div class="swiper-lazy-preloader"></div>
                            <div class="img-caption-title">
                                <span class="h3">{{$transport->title}}</span>
                                <br>
                                <span class="text-sm">{{$transport->text}}</span>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
        <div class="swiper-pagination relative"></div>
    </div>
</div>
@endif
