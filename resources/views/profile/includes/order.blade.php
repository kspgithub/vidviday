<div class="accordion-item">
    <div class="accordion-title">
        <span class="text">{{$order->created_at?->format('d.m.Y')}}</span>
        <span class="h4">{{$order->tour ? $order->tour->title : 'Корпоратив'}}</span>
        <div class="calendar-header-center {{$order->status_class}}">
            <span class="text-sm">{{$order->status_text}}</span>
        </div>
        @if(!empty($order->act))
            <div class="download"></div>
        @endif
        <i></i>
    </div>

    <div class="accordion-inner px-0">
        <div class="history">
            <div class="row">
                <div class="col-6">
                    <span class="text-sm">Дата проведення</span>
                </div>

                <div class="col-6">
                    <span class="text-sm">{{$order->event_title}}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <span class="text-sm">Кількість учасників</span>
                </div>

                <div class="col-6">
                    <span
                        class="text-sm">{{$order->places}} {{plural_form($order->places, ['особа', 'особи', 'осіб'])}}</span>
                </div>
            </div>
            @if($order->children)
                @if($order->children_young > 0)
                    <div class="row">
                        <div class="col-6">
                            <span class="text-sm">Діти віком до 6</span>
                        </div>

                        <div class="col-6">
                            <span
                                class="text-sm">{{$order->children_young}} {{plural_form($order->children_young, ['особа', 'особи', 'осіб'])}}</span>
                        </div>
                    </div>
                @endif
                @if($order->children_older > 0)
                    <div class="row">
                        <div class="col-6">
                            <span class="text-sm">Діти віком від 6 до 12 років</span>
                        </div>

                        <div class="col-6">
                            <span
                                class="text-sm">{{$order->children_older}} {{plural_form($order->children_older, ['особа', 'особи', 'осіб'])}}</span>
                        </div>
                    </div>
                @endif
            @endif
            @if($order->price > 0)
                <div class="row">
                    <div class="col-6">
                        <span class="text-sm">Вартість туру</span>
                    </div>

                    <div class="col-6">
                        <span class="text-sm">{{to_currency($order->price, $order->currency)}}</span>
                    </div>
                </div>
                @if(!empty($order->discounts))
                    @foreach($order->discounts as $discount)
                        <div class="row">
                            <div class="col-6">
                                <span class="text-sm">{{$discount['title']}}</span>
                            </div>

                            <div class="col-6">
                                <span class="text-sm">-{{to_currency($discount['value'], $order->currency)}}</span>
                            </div>
                        </div>
                    @endforeach
                @elseif($order->discount > 0)

                    <div class="row">
                        <div class="col-6">
                            <span class="text-sm">Знижка</span>
                        </div>

                        <div class="col-6">
                            <span class="text-sm">-{{to_currency($order->discount, $order->currency)}}</span>
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-6">
                        <span class="text-sm">Кінцева вартість</span>
                    </div>

                    <div class="col-6">
                        <span class="text-sm">{{to_currency($order->total_price, $order->currency)}}</span>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-6">
                    <span class="text-sm">Завантаження</span>
                </div>

                <div class="col-6">
                    @if(!empty($order->act))
                        <a href="{{$order->act}}" download class="download">Акт виконаних робіт</a>
                    @endif
                    <br>
                    @if(!empty($order->info_sheet))
                        <a href="{{$order->info_sheet}}" download class="download">Завантажити інфо-лист</a>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    @if($order->status === Order::STATUS_COMPLETED)
                        <span v-is="'order-testimonial-btn'"
                              key="order-testimonial-btn-{{$order->id}}"
                              :tour='{{$order->tour ? json_encode($order->tour->shortInfo()) : null}}'
                              url="{{route('testimonials.index')}}">
                            {{ __('forms.leave-feedback') }}
                        </span>
                    @endif
                    @if($order->status < Order::STATUS_PAYED)
                        <span v-is="'order-cancel-btn'"
                              key="order-cancel-btn-{{$order->id}}"
                              :order='@json($order)'>Скасувати замовлення</span>
                    @endif

                    @if($order->status >= Order::STATUS_PAYED && $order->status !== Order::STATUS_COMPLETED)
                        <span class="btn type-1 disabled-btn">Скасувати замовлення</span>
                    @endif
                </div>
            </div>

        </div>

        <div class="spacer-xs"></div>
        @if($order->status < Order::STATUS_COMPLETED)
            <div v-is="'order-notes'"
                 :order='@json($order)'
                 :notes='@json($order->notes)'
            >

            </div>
        @endif
    </div>
</div>
