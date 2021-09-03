<div class="accordion-item" id="reviews-accordion">
    <div class="accordion-title"><span><img src="{{asset('/img/preloader.png')}}"
                                            data-img-src="{{asset('/icon/rating.svg')}}"
                                            alt="rating"></span>Відгуки ({{$tour->testimonials->count()}})<i></i>
    </div>
    <div class="accordion-inner">
        <span class="btn btn-block-sm type-1 open-popup" data-rel="testimonial-popup">Залишити відгук</span>
        <div class="spacer-xs"></div>
        @if($tour->testimonials->count() > 0)
            <hr>
            <div class="spacer-xs"></div>
            @foreach($tour->testimonials as $testimonial)
                <x-tour.testimonial :testimonial="$testimonial"/>
            @endforeach
            <div class="spacer-xs"></div>
            <hr>
            <div class="spacer-xs"></div>
            <span class="btn btn-block-sm type-1 open-popup" data-rel="testimonial-popup">Залишити відгук</span>
        @endif
    </div>
</div>
