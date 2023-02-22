<div {{$attributes->merge(['class'=> $mode])}}
     @if($vue)
     v-is="'tour-card'"
     :tour="{{ json_encode($tour) }}"
     {{ Auth::check() ? 'like-btn' : '' }}
     :history="{{$history ? 'true' : 'false'}}"
    @endif
>
    <div class="thumb-img">
        @foreach($tour->badges as $key=>$badge)
            <div class="label label-{{$key}}" style="background-color: {{$badge->color}}">{{$badge->title}}</div>
        @endforeach
        <img src="{{asset('img/preloader.png')}}"
             data-img-src="{{$tour->main_image}}"
             alt="{{ $tour->title }}">
        <a href="{{$tour->url}}" class="full-size"></a>
    </div>
    <div class="thumb-content">
        <div class="title h3">
            <a href="{{$tour->url}}">{{$tour->title}}</a>
        </div>
        <span class="stars select-stars stars-selected">
            @for($i=1; $i <=5; $i++)
                <i class="select-icon {{($tour->rating ?: $tour->testimonials_avg_rating) >= $i ? 'icon-star' : 'icon-star-empty'}}"></i>
            @endfor
            @if($tour->testimonials_count > 0)
                <a class="text" href="#testimonials">
                    <a href="{{ $tour->url }}#reviews-accordion" class="text">{{$tour->testimonials_count}} {{plural_form($tour->testimonials_count, ['відгук', 'відгука', 'відгуків'])}}</a>
                </a>
            @endif
        </span>
        @if($mode === 'thumb')
            <div class="datepicker-input">
                <select>
                    @foreach($tour->scheduleItems as  $scheduleItem)
                        <option value="{{$scheduleItem->id}}">{{$scheduleItem->title}}</option>
                    @endforeach
                </select>
            </div>
            @if($schedule->exists)
                @if($tour->order_enabled)
                    <div class="thumb-info">
                    <span
                        class="thumb-info-time text">{!! $tour->format_duration !!}</span>
                        <span class="thumb-info-people text">
                        {{$schedule->places_available >= 10 ? '10+' : ($schedule->places_available < 2 ? '2-10' : '0')}}
                    </span>
                        @if($schedule->places_available <= 2)
                            <span class="thumb-info-people text">{{$schedule->places_available}}<span class="tooltip-wrap black">
                            <span
                                class="tooltip text text-sm light">{{$schedule->places_available === 0 ? 'Немає місць' : 'Місця закінчуються'}}</span>
                        </span></span>
                        @endif
                    </div>
                @endif
                @if($tour->order_enabled)
                    <div class="thumb-price">
                        <span class="text">Ціна:<span>{{currency_value($schedule->price ?: 0, $schedule->currency)}}</span>
                            <i>{{current_currency($schedule->currency)}}</i>
                        </span>
                            @if(is_tour_agent() && $schedule->commission > 0 && !$history)
                                <span class="discount hidden-print">{{ceil($schedule->commission)}} грн. <span class="tooltip-wrap red"><span
                                            class="tooltip text text-sm light">Комісія агента</span></span></span>
                            @endif
                    </div>
                @endif
            @endif
            <a v-bind="$buttons('order.tour')" href="{{route('tour.order', $tour)}}" class="btn type-1 btn-block">Замовити Тур</a>
        @else
            <div class="text">
                <p>{{str_limit($tour->short_text, 150)}}
                    <a v-bind="$buttons('tour.show_more')" href="{{$tour->url}}" class="btn btn-read-more text-bold">Більше</a>
                </p>
            </div>
        @endif
    </div>

    @if($mode === 'thumb')
        <div class="thumb-desc text">
            <p>{{$tour->short_text}}
                <a v-bind="$buttons('tour.show_more')" href="{{$tour->url}}" class="btn btn-read-more text-bold">Більше</a>
            </p>
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
                <span class="thumb-info-people text">
                    {{$schedule->places_available >= 10 ? '10+' : ($schedule->places_available < 2 ? '2-10' : '0')}}
                </span>
                @if($schedule->places_available <= 2)
                    <span class="thumb-info-people text">{{$schedule->places_available}}<span class="tooltip-wrap black">
                    <span
                        class="tooltip text text-sm light">{{$schedule->places_available === 0 ? 'Немає місць' : 'Місця закінчуються'}}</span>
                </span></span>
                @endif
            </div>
            <div class="thumb-price">
                <span class="text">Ціна:<span>{{ceil($schedule->price)}}</span><i>грн</i></span>
                @if(is_tour_agent() && $schedule->commission > 0 && !$history)
                    <span class="discount hidden-print">{{ceil($schedule->commission)}} грн. <span class="tooltip-wrap red"><span
                                class="tooltip text text-sm light">Комісія агента</span></span></span>
                @endif
            </div>
            <a v-bind="$buttons('order.tour')" href="{{route('tour.order', $tour->id)}}" class="btn type-1 btn-block">Замовити Тур</a>
        </div>
    @endif
</div>
