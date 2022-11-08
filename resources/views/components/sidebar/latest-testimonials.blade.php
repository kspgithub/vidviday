@if($testimonials->count() > 0)
    <div class="sidebar-item p-0">
        <div class="top-part b-border">
            <div class="title h3 title-icon">
                <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/reviews.svg')}}"
                     alt="reviews">
                <span>{{$title}}</span>
            </div>
        </div>
        <div class="bottom-part">
            <div class="latest-testimonials">
                @foreach($testimonials as $i => $testimonial)
                    <div class="review" {{--style="{{ $i > 1 ? 'display: none' : '' }}"--}}>
                        <div class="review-header">
                            <div class="review-img">
                                @if($testimonial->avatar || empty($testimonial->initials))
                                    <img loading="lazy" src="{{asset('/img/preloader.png')}}"
                                         data-img-src="{{$testimonial->avatar_url}}"
                                         width="{{$testimonial->dimensions['thumb']['width']}}"
                                         height="{{$testimonial->dimensions['thumb']['height']}}"
                                         alt="user">
                                @else
                                    <span class="h4 full-size">{{$testimonial->initials}}</span>
                                @endif
                            </div>
                            <div class="review-title">
                                <span class="h4">{{$testimonial->name}}</span>
                                <span class="text text-sm">{{$testimonial->created_at?->format('d.m.Y')}}</span>
                                <span class="text text-sm">{{$testimonial->created_at?->format('H:i')}}</span>
                                <x-tour.star-rating :rating="$testimonial->rating"/>
                            </div>
                        </div>
                        <div class="text">
                            @if($testimonial->tour)
                                <p>@lang('Tour'): <a
                                        href="{{$testimonial->tour->url}}">{{str_limit(strip_tags(html_entity_decode($testimonial->tour->title)), 50)}}</a>
                                </p>
                            @endif
                            <div class="seo-text load-more-wrapp p-0 m-0">
                                @if(mb_strlen($testimonial->short_text) >= $testimonial::SHORT_TEXT_STR_LIMIT + 3)
                                    <div class="less-info">
                                        <p>{!! $testimonial->short_text !!}</p>
                                    </div>
                                    <div class="more-info">
                                        <p>{!! $testimonial->text !!}</p>
                                    </div>

                                    @if($testimonial->tour)
                                        <a class="btn btn-read-more text-bold d-inline" href="{{$testimonial->tour->url}}#testimonial-{{$testimonial->id}}">
                                            {{__('common.more')}}
                                        </a>
                                    @else
                                        <div class="show-more">
                                            <span>{{__('tours-section.show-more')}}</span>
                                            <span>{{__('common.hide-text')}}</span>
                                        </div>
                                    @endif

                                @else
                                    <p>{!! $testimonial->text !!}</p>
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach
                <a href="{{$btnUrl}}" class="btn type-2 btn-block">{{$btnText}}</a>
            </div>

        </div>
    </div>
@endif
