@if($news->count() > 0)
    <div class="sidebar-item only-desktop">
        <div class="top-part b-border">
            <div class="title h3 title-icon">
                <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/mailing.svg')}}"
                     alt="mailing">
                <span>{{ __("sidebar-section.news") }}</span>
            </div>
        </div>
        <div class="bottom-part">
            <div class="news-links">

                @foreach($news as $post)

                    <div class="news-item">
                        <a href="{{ route("news.single", ["slug" => $post->slug]) }}"
                           class="title">{{ $post->title }}</a>
                        <div class="news-date">{{ $post->created_at?->format("d.m.Y") }}</div>
                    </div>

                @endforeach

            </div>
            <a v-bind="$buttons.news.latest" href="{{ route('news.index') }}" class="btn type-2">{{ __("sidebar-section.all-news") }}</a>
        </div>
    </div>
@endif
