@if($items->count() > 0)
    <div class="sidebar-item testimonials">
        <div class="top-part b-border">
            <div class="title h3 title-icon">
                <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/reviews.svg')}}"
                     alt="reviews">
                <span>{{ __("Нас рекомендують") }}</span>
            </div>
        </div>
        <div class="bottom-part">
            <div class="only-desktop" v-is="'sidebar-recommendations'">

                <x-sidebar.recommendation-item :item="$items->first()"/>

                @if($items->count() > 1)
                    <a href="{{$testimonialsUrl}}"
                       class="btn type-2 btn-block show_more">{{__('tours-section.show-more')}}</a>
                    @foreach($items as $key=>$item)
                        @if($key> 0)
                            <div class="divider d-none"></div>
                            <x-sidebar.recommendation-item :item="$item" :hidden="true"/>
                        @endif
                    @endforeach
                @endif
            </div>

            <div class="only-pad-mobile">
                <div class="swiper-entry">
                    <div class="swiper-button-prev inner bottom-2 only-mobile" tabindex="0" role="button"
                         aria-label="Previous slide" aria-disabled="false">
                        <i></i>
                    </div>
                    <div class="swiper-button-next inner bottom-2 only-mobile" tabindex="0" role="button"
                         aria-label="Next slide" aria-disabled="false">
                        <i></i>
                    </div>
                    <div class="swiper-container swiper-container-initialized swiper-container-horizontal">
                        <div class="swiper-wrapper" style="transition-duration: 0ms;">
                            @foreach($items as $key=>$item)
                                <div class="swiper-slide">
                                    <x-sidebar.recommendation-item :item="$item"/>
                                </div>
                            @endforeach

                        </div>
                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                    </div>
                    <div class="swiper-pagination relative swiper-pagination-clickable swiper-pagination-bullets"></div>
                </div>
            </div>
        </div>
    </div>
@endif
