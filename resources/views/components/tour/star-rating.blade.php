@props([
    'rating'=> 0,
    'trigger'=>false,
    'triggerTarget'=>'#reviews-accordion',
    'count'=>0,
])
<span {{$attributes->merge(['class'=>'stars select-stars stars-selected'])}}>
    @for($i=1; $i <=5; $i++)
        <i class="select-icon {{$rating >= $i ? 'icon-star' : 'icon-star-empty'}}"></i>
    @endfor
    @if($count> 0)
        @if($trigger)
            <a href="{{$triggerTarget}}" class="text accordion-open-trigger">
                {{$count}} {{plural_form($count, ['відгук', 'відгука', 'відгуків'])}}
            </a>
        @else
            <span class="text">
                {{$count}} {{plural_form($count, ['відгук', 'відгука', 'відгуків'])}}
            </span>
        @endif
    @endif
</span>
