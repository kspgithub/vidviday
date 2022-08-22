@props([
    'testimonial'=>new \App\Models\Testimonial(),
    'short'=> false
])
<div class="review-item" id="testimonial-{{ $testimonial->id }}">
    <div class="spacer-xs"></div>
    <div class="review">
        <div class="review-header">
            <div class="review-img">
                @if(!empty($testimonial->avatar))
                    <img src="{{asset('/img/preloader.png')}}"
                         data-img-src="{{$testimonial->avatar_url}}" alt="user">
                @else
                    <span class="full-size h4">{{$testimonial->initials}}</span>
                @endif
            </div>
            <div class="review-title">
                <span class="h4">{{$testimonial->name}}</span>
                <span class="text text-sm">{{$testimonial->created_at->format('d.m.Y')}}</span>
                <span class="text text-sm">{{$testimonial->created_at->format('H:i')}}</span>
                @if($testimonial->on_moderation)
                    <span class="text text-sm">@lang('tours-section.reviews.in-moderation')</span>
                @else
                    @if(!$testimonial->parent_id)
                        <x-tour.star-rating :rating="$testimonial->rating"/>
                    @endif
                    @if(!$short)
                        <span class="text" v-is="'open-testimonial-form'"
                              :parent="{{$testimonial->id}}">@lang('tours-section.reviews.answer')</span>
                    @endif
                @endif
            </div>
        </div>
{{--        <div class="text text-md">--}}
{{--            <p>@if($testimonial->parent)<span--}}
{{--                    class="label">{{$testimonial->parent->name}}</span> @endif{{$testimonial->text}}--}}
{{--            </p>--}}
{{--        </div>--}}
        <div class="seo-text load-more-wrapp p-0 m-0">
            @if(mb_strlen($testimonial->short_text) <= $testimonial::SHORT_TEXT_STR_LIMIT + 3)
                <div class="less-info">
                    <p>{!! $testimonial->short_text !!}</p>
                </div>
                <div class="more-info">
                    <p>{!! $testimonial->text !!}</p>
                </div>

                <div class="show-more">
                    <span>Читати більше</span>
                    <span>Сховати текст</span>
                </div>
            @else
                <p>{!! $testimonial->text !!}</p>
            @endif
        </div>
    </div>
    @if(!$short && !$testimonial->parent_id && $testimonial->children->count() > 0)
        <div class="load-more-wrapp">
            <div class="show-more active">
                <span>@lang('tours-section.reviews.hide-answers')</span>
                <span>@lang('tours-section.reviews.show-answers')</span>
            </div>
            <div class="more-info">
                @foreach($testimonial->children as $child)
                    <x-tour.testimonial :testimonial="$child"/>
                @endforeach
            </div>
        </div>
    @elseif(!$short && $testimonial->children->count() > 0)
        @foreach($testimonial->children as $child)
            <x-tour.testimonial :testimonial="$child"/>
        @endforeach
    @endif
</div>
