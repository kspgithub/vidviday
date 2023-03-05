@php use App\Models\Staff;use App\Models\Tour; @endphp
@if($testimonials->count() > 0)
    <div class="sidebar-item p-0 no-print">
        <div class="top-part b-border">
            <div class="title h3 title-icon">
                <img loading="lazy" src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/reviews.svg')}}"
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
                            @if($testimonial->guide)
                                <p>
                                    @lang('Guide'): <a href="{{$testimonial->guide->url}}">{{$testimonial->guide->name}}</a>
                                </p>
                            @elseif($testimonial->tour)
                                <p>
                                    @lang('Tour'): <a href="{{$testimonial->tour->url}}">{{$testimonial->tour->title}}</a>
                                </p>
                            @elseif($testimonial->place)
                                <p>
                                    @lang('Place'): <a href="{{$testimonial->place->url}}">{{$testimonial->place->title}}</a>
                                </p>
                            @endif
                            <div class="seo-text load-more-wrapp p-0 m-0">
                                <div class="less-info">
                                    <p>{!! $testimonial->short_text !!}</p>
                                </div>
                                <div class="more-info">
                                    <p>{!! $testimonial->text !!}</p>
                                </div>

                                @if($testimonial->tour)
                                    <x-seo-button :code="'goto.tour_testimonial'" class="btn btn-read-more text-bold d-inline"
                                       href="{{$testimonial->tour->url}}#testimonial-{{$testimonial->id}}">
                                        {{__('common.more')}}
                                    </x-seo-button>
                                @else
                                    <div class="show-more">
                                        <span>{{__('tours-section.show-more')}}</span>
                                        <span>{{__('common.hide-text')}}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                <x-seo-button :code="'testimonial.next'" href="{{$btnUrl}}" class="btn type-2 btn-block">{{$btnText}}</x-seo-button>
            </div>

        </div>
    </div>
@endif
