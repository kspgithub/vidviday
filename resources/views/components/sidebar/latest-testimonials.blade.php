@if($testimonials->count() > 0)
    <div class="sidebar-item">
        <div class="top-part b-border">
            <div class="title h3 title-icon">
                <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/reviews.svg')}}"
                     alt="reviews">
                <span>{{$title}}</span>
            </div>
        </div>
        <div class="bottom-part">
            <div class="only-desktop">
                @foreach($testimonials as $testimonial)
                    <div class="review">
                        <div class="review-header">
                            <div class="review-img">
                                @if($testimonial->avatar || empty($testimonial->initials))
                                    <img src="{{asset('/img/preloader.png')}}"
                                         data-img-src="{{$testimonial->avatar_url}}"
                                         alt="user">
                                @else
                                    <span class="h4 full-size">{{$testimonial->initials}}</span>
                                @endif
                            </div>
                            <div class="review-title">
                                <span class="h4">{{$testimonial->name}}</span>
                                <span class="text text-sm">{{$testimonial->created_at->format('d.m.Y')}}</span>
                                <span class="text text-sm">{{$testimonial->created_at->format('H:i')}}</span>
                                <x-tour.star-rating :value="$testimonial->rating"/>
                            </div>
                        </div>
                        <div class="text">
                            @if($type === 'tour')
                                <p>@lang('Tour'): <a
                                        href="{{$testimonial->tour->url}}">{{$testimonial->tour->title}}</a>
                                </p>
                            @endif
                            <p>{{$testimonial->text}}</p>
                        </div>
                    </div>
                @endforeach
                <a href="{{route('testimonials.index')}}" class="btn type-2 btn-block">{{$btnText}}</a>
            </div>

            <div class="only-pad-mobile">
                <div class="swiper-entry">
                    <div class="swiper-button-prev inner bottom-2 only-mobile">
                        <i></i>
                    </div>
                    <div class="swiper-button-next inner bottom-2 only-mobile">
                        <i></i>
                    </div>
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach($testimonials as $testimonial)
                                <div class="swiper-slide">
                                    <div class="review">
                                        <div class="review-header">
                                            <div class="review-img">
                                                @if($testimonial->avatar || empty($testimonial->initials))
                                                    <img src="{{asset('/img/preloader.png')}}"
                                                         data-img-src="{{$testimonial->avatar_url}}"
                                                         alt="user">
                                                @else
                                                    <span class="h4 full-size">{{$testimonial->initials}}</span>
                                                @endif
                                            </div>
                                            <div class="review-title">
                                                <span class="h4">{{$testimonial->name}}</span>
                                                {{--                                <span class="text text-sm">туроператор «Піраміда Тур»</span>--}}
                                            </div>
                                        </div>
                                        <div class="text">
                                            <p>{{str_limit($testimonial->text, 200)}}</p>
                                        </div>
                                    </div>
                                    @if(strlen($testimonial->text) > 200)
                                        <div class="seo-text load-more-wrapp">
                                            <div class="more-info">
                                                <div class="text">
                                                    <p>{!! $testimonial->text !!}</p>
                                                </div>
                                                <div class="spacer-xs"></div>
                                            </div>
                                            <div class="show-more">
                                                <span>Читати більше</span>
                                                <span>Сховати текст</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="swiper-pagination relative"></div>
                </div>
            </div>


        </div>
    </div>
@endif
