<div class="img img-border img-caption style-2">
    <div class="zoom centered">
        <img loading="lazy" src="{{asset('img/preloader.png')}}"
             data-src="{{ $specialist->avatar_url ?? asset('img/no-image.png') }}"
             alt="{{$specialist->first_name}} {{$specialist->last_name}}">
        <a href="{{ $specialist->url }}" class="full-size"></a>
    </div>
    <div class="img-caption-info">
        <div class="guide-name">
            <span class="h3">
                <a href="{{ $specialist->url }}">{{$specialist->first_name}} {{$specialist->last_name}}</a>
            </span>
            <span class="text">{{$specialist->testimonials_count}} відгуків</span>
        </div>
        <span class="text">Проводить <b>{{$specialist->tours_count}} турів</b></span>
        <x-seo-button :code="'goto.staff'" href="{{ $specialist->url }}" class="btn type-1 btn-block">Дізнатись більше</x-seo-button>
    </div>
</div>
