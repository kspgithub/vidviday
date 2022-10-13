<div class="accordion-item hidden-print" id="reviews-accordion">
    <div class="accordion-title"><span><img src="{{asset('/img/preloader.png')}}"
                                            data-img-src="{{asset('/icon/rating.svg')}}"
                                            alt="rating"></span>@lang('tours-section.reviews.title')
        ({{$tour->testimonials_count}})<i></i>
    </div>
    <div class="accordion-inner">

        <div v-is="'testimonial-list'"
             url="{{route('tour.testimonials', $tour)}}"
        ></div>

    </div>
</div>
