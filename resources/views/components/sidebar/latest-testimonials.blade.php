@if($testimonials->count() > 0)
<div class="sidebar-item">
    <div class="top-part b-border">
        <div class="title h3 title-icon">
            <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/reviews.svg')}}"
                 alt="reviews">
            <span>Відгуки</span>
        </div>
    </div>
    <div class="bottom-part">
        @foreach($testimonials as $testimonial)
        <div class="review">
            <div class="review-header">
                <div class="review-img">
                    @if($testimonial->avatar || empty($testimonial->initials))
                    <img src="{{asset('/img/preloader.png')}}" data-img-src="{{$testimonial->avatar_url}}" alt="user">
                    @else
                        <span class="h4 full-size">{{$testimonial->initials}}</span>
                    @endif
                </div>
                <div class="review-title">
                    <span class="h4">{{$testimonial->name}}</span>
                    <span class="text text-sm">{{$testimonial->created_at->format('d.m.Y')}}</span>
                    <span class="text text-sm">{{$testimonial->created_at->format('H:i')}}</span>
                    <x-tour.star-rating :value="$testimonial->rating" />
                </div>
            </div>
            <div class="text">
                <p>Тур: <a href="{{$testimonial->model->url}}">{{$testimonial->model->title}}</a></p>
                <p>{{$testimonial->text}}</p>
            </div>
        </div>
        @endforeach
        <a href="{{route('testimonials.index')}}" class="btn type-2 btn-block">Показати всі відгуки</a>
    </div>
</div>
@endif
