<div class="accordion-item hidden-print" id="reviews-accordion">
    <div class="accordion-title"><span><img src="{{asset('/img/preloader.png')}}"
                                            data-img-src="{{asset('/icon/rating.svg')}}"
                                            alt="rating"></span>@lang('tours-section.reviews.title')
        ({{$tour->testimonials->count()}})<i></i>
    </div>
    <div class="accordion-inner">

        <div v-is="'testimonial-list'"
             :items='@json($tour->testimonials->toTree())'
             url="{{route('testimonials.index')}}"
        ></div>

    </div>
</div>
