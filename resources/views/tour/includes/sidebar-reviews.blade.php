@if($tour->testimonials->count() > 0)
    <div class="sidebar-item testimonials only-desktop hidden-print">
        <div class="top-part b-border">
            <div class="title h3 title-icon">
                <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/reviews.svg')}}"
                     alt="reviews">
                <span>Відгуки</span>
            </div>
        </div>
        <div class="bottom-part">
            @foreach($tour->testimonials->where('parent_id', null)->take(2) as $testimonial)
                <x-tour.testimonial :testimonial="$testimonial" :short="true"/>
            @endforeach
            <a href="#reviews-accordion" class="btn type-2 btn-block">Показати всі відгуки</a>
        </div>
    </div>
@endif
