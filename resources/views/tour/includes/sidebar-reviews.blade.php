@if($testimonials->count() > 0)
    <div class="sidebar-item testimonials only-desktop hidden-print">
        <div class="top-part b-border">
            <div class="title h3 title-icon">
                <img loading="lazy" src="{{asset('/img/preloader.png')}}" data-src="{{asset('/icon/reviews.svg')}}"
                     alt="reviews">
                <span>@lang('tours-section.reviews.title')</span>
            </div>
        </div>
        <div class="bottom-part">
            @foreach($testimonials/*->where('rating', '>=', 4)->where('parent_id', null)->take(2)*/ as $testimonial)
                <x-tour.testimonial :testimonial="$testimonial" :short="true"/>
            @endforeach
            <x-seo-button :code="'testimonial.show_all'" href="#reviews-accordion"
                          class="btn type-2 btn-block">@lang('tours-section.reviews.show-all-reviews')</x-seo-button>
        </div>
    </div>
@endif
