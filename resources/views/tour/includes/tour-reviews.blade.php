<div class="accordion-item hidden-print" id="reviews-accordion">
    <div class="accordion-title"><span><img src="{{asset('/img/preloader.png')}}"
                                            data-img-src="{{asset('/icon/rating.svg')}}"
                                            alt="rating"></span>@lang('tours-section.reviews.title')
        ({{$tour->testimonials->count()}})<i></i>
    </div>
    <div class="accordion-inner">
        <div></div>
        <span class="btn btn-block-sm type-1" v-is="'open-testimonial-form'" :parent='0'>
            @lang('tours-section.reviews.leave-review')
        </span>
        <div class="spacer-xs"></div>
        @if($tour->testimonials->count() > 0)
            <hr>
            <div class="spacer-xs"></div>

            @foreach($tour->testimonials->toTree() as $testimonial)
                <x-tour.testimonial :testimonial="$testimonial"/>
            @endforeach
            <div class="spacer-xs"></div>
            <hr>
            <div class="spacer-xs"></div>
            <span class="btn btn-block-sm type-1" v-is="'open-testimonial-form'" :parent='0'>
                @lang('tours-section.reviews.leave-review')
            </span>
        @endif
    </div>
</div>
