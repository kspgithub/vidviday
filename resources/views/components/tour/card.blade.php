<div {{$attributes->merge(['class'=> $mode])}}
     @if($vue)
     v-is="'tour-card'"
     :tour='@json($tour)'
     {{ Auth::check() ? 'like-btn' : '' }}
     :history="{{$history ? 'true' : 'false'}}"
    @endif
>
    <div class="thumb-img">
        @foreach($tour->badges as $key=>$badge)
            <div class="label label-{{$key}}" style="background-color: {{$badge->color}}">{{$badge->title}}</div>
        @endforeach
        <img src="{{asset('img/preloader.png')}}" data-img-src="{{$tour->main_image}}" alt="tour 1">
        <a href="{{$tour->url}}" class="full-size"></a>
    </div>
    <div class="thumb-content">
        <div class="title h3">
            <a href="{{$tour->url}}">{{$tour->title}}</a>
        </div>
        <span class="stars select-stars stars-selected">
            @for($i=1; $i <=5; $i++)
                <i class="select-icon {{$tour->rating >= $i ? 'icon-star' : 'icon-star-empty'}}"></i>
            @endfor
            @if($tour->count_testimonials > 0)
                <span
                    class="text">{{$tour->testimonials_count}} {{plural_form($tour->testimonials_count, ['відгук', 'відгука', 'відгуків'])}}</span>
            @endif
        </span>
        @if($mode === 'thumb')
            <div class="datepicker-input">
                <select>
                    @foreach($tour->scheduleItems as  $schedule)
                        <option value="{{$schedule->id}}">{{$schedule->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="thumb-info">
                <span
                    class="thumb-info-time text">{!! $tour->format_duration !!}</span>
                <span class="thumb-info-people text">{{$schedule->places >= 10 ? '10+' : $schedule->places}}</span>
                @if($schedule->places <= 2)
                    <span class="thumb-info-people text">{{$schedule->places}}<span class="tooltip-wrap black">
                        <span
                            class="tooltip text text-sm light">{{$schedule->places === 0 ? 'Немає місць' : 'Місця закінчуються'}}</span>
                    </span></span>
                @endif
            </div>
            <div class="thumb-price">
                <span class="text">Ціна:<span>{{ceil($schedule->price)}}</span><i>грн</i></span>
                @if(is_tour_agent() && $schedule->commission > 0 && !$history)
                    <span class="discount">{{ceil($schedule->commission)}} грн. <span class="tooltip-wrap red"><span
                                class="tooltip text text-sm light">Комісія агента</span></span></span>
                @endif
            </div>
            <a href="{{route('tour.order', $tour)}}" class="btn type-1 btn-block">Замовити Тур</a>
        @else
            <div class="text">
                <p>{{str_limit($tour->short_text, 150)}} <a href="{{$tour->url}}" class="btn btn-read-more text-bold">Більше</a>
                </p>
            </div>
        @endif
    </div>

    @if($mode === 'thumb')
        <div class="thumb-desc text">
            <p>{{$tour->short_text}} <a href="{{$tour->url}}" class="btn btn-read-more text-bold">Більше</a></p>
        </div>
    @else
        <div class="thumb-content">
            <div class="datepicker-input">
                <select>
                    @foreach($tour->scheduleItems as  $schedule)
                        <option value="{{$schedule->id}}">{{$schedule->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="thumb-info">
                <span
                    class="thumb-info-time text">{!! $tour->format_duration !!}</span>
                <span class="thumb-info-people text">{{$schedule->places >= 10 ? '10+' : $schedule->places}}</span>
                @if($schedule->places <= 2)
                    <span class="thumb-info-people text">{{$schedule->places}}<span class="tooltip-wrap black">
                    <span
                        class="tooltip text text-sm light">{{$schedule->places === 0 ? 'Немає місць' : 'Місця закінчуються'}}</span>
                </span></span>
                @endif
            </div>
            <div class="thumb-price">
                <span class="text">Ціна:<span>{{ceil($schedule->price)}}</span><i>грн</i></span>
                @if(is_tour_agent() && $schedule->commission > 0 && !$history)
                    <span class="discount">{{ceil($schedule->commission)}} грн. <span class="tooltip-wrap red"><span
                                class="tooltip text text-sm light">Комісія агента</span></span></span>
                @endif
            </div>
            <a href="{{route('tour.order', $tour->id)}}" class="btn type-1 btn-block">Замовити Тур</a>
        </div>
    @endif
</div>
