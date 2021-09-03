@props([
    'testimonial'=>new \App\Models\Testimonial()
])
<div class="review-item">
    <div class="spacer-xs"></div>
    <div class="review">
        <div class="review-header">
            <div class="review-img">
                @if(!empty($testimonial->avatar))
                    <img src="{{asset('/img/preloader.png')}}"
                         data-img-src="{{$testimonial->user->avatar_url}}" alt="user">
                @else
                    <span class="full-size h4">{{$testimonial->initials}}</span>
                @endif
            </div>
            <div class="review-title">
                <span class="h4">{{$testimonial->name}}</span>
                <span class="text text-sm">{{$testimonial->created_at->format('d.m.Y')}}</span>
                <span class="text text-sm">{{$testimonial->created_at->format('H:i')}}</span>
                @if(!$testimonial->parent_id)
                    <x-tour.star-rating :rating="$testimonial->rating"/>
                @endif
                <span class="text">Відповісти</span>
            </div>
        </div>
        <div class="text text-md">
            <p>@if($testimonial->parent)<span
                    class="label">{{$testimonial->parent->name}}</span> @endif{{$testimonial->text}}
            </p>
        </div>
    </div>
    @if(!$testimonial->parent_id && $testimonial->children->count() > 0)
        <div class="load-more-wrapp">
            <div class="show-more active">
                <span>Приховати відповіді</span>
                <span>Показати відповіді</span>
            </div>
            <div class="more-info">
                @foreach($testimonial->children as $child)
                    <x-tour.question :question="$child"/>
                @endforeach
            </div>
        </div>
    @elseif($testimonial->children->count() > 0)
        @foreach($testimonial->children as $child)
            <x-tour.question :question="$child"/>
        @endforeach
    @endif
</div>
