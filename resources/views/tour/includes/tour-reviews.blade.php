<div class="accordion-item hidden-print root-item" id="reviews-accordion">
    <div class="accordion-title">
        <span>
            <img loading="lazy" src="{{asset('/img/preloader.png')}}"
                 data-src="{{asset('/icon/rating.svg')}}"
                 alt="rating">
        </span>
        @lang('tours-section.reviews.title')
        ({{$tour->testimonials_count + $tour->related_testimonials_count}})<i></i>
    </div>
    <div class="accordion-inner">

        @if($sync = true)
            <div v-is="'testimonial-list'"
                 url="{{route('tour.testimonials', $tour)}}"
            ></div>
        @endif

    </div>
</div>
