@props([
    'testimonial'=>new \App\Models\Testimonial(),
    'subclass'=>'',
    'short'=> false
])
<div class="review-item">
    <div class="spacer-xs"></div>
    <div class="review {{$subclass}}">
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
                    <span class="text text-sm">На модерації</span>
                @else
                    @if(!$testimonial->parent_id)
                        <x-tour.star-rating :rating="$testimonial->rating"/>
                    @endif
                    @if(!$short)
                        <span class="text" v-is="'open-testimonial-form'"
                              :parent="{{$testimonial->id}}">Відповісти</span>
                    @endif
                @endif
            </div>
        </div>
        <div class="text text-md">
            <p>@if($testimonial->parent)<span
                    class="label">{{$testimonial->parent->name}}</span> @endif{{$testimonial->text}}
            </p>
        </div>
    </div>
    <form action="/" class="new-review d-none">
        <input type="hidden" name="parent_id" value="{{$testimonial->id}}">
        <div class="review-img">
            <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('img/user.jpg')}}" alt="user">
        </div>
        <label>
            <i>Залиште коментар</i>
            <textarea name="review"></textarea>
        </label>
        <div class="text-right">
            <span class="btn type-3">Відмінити</span>
            <span class="btn type-1 open-popup" data-rel="thanks-popup">Відповісти</span>
        </div>
    </form>
    @if(!$short && !$testimonial->parent_id && $testimonial->children->count() > 0)
        <div class="load-more-wrapp">
            <div class="show-more">
                <span>Показати відповіді</span>
                <span>Приховати відповіді</span>
            </div>
            <div class="more-info" style="display: none;">
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
