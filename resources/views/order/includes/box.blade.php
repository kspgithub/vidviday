<div class="bordered-box">
    @if($order->tour_id > 0)
        <div class="row">
            <div class="col-sm-6 col-12">
                <span class="text">Назва туру</span>
            </div>

            <div class="col-sm-6 col-12">
                <span class="text"><b>{{$order->tour->title}}</b></span>
            </div>
        </div>
        <hr>
    @endif
    @if($order->start_date ?? false)
        <div class="row">
            <div class="col-sm-6 col-12">
                <span class="text">Дата виїзду</span>
            </div>

            <div class="col-sm-6 col-12">
                <span class="text"><b>{{$order->start_title}}</b></span>
            </div>
        </div>
        <hr>
    @endif
    @if($order->duration > 0)
        <div class="row">
            <div class="col-sm-6 col-12">
                <span class="text">Тривалість</span>
            </div>

            <div class="col-sm-6 col-12">
                                            <span class="text">
                                                <b>{{$order->duration.' '.plural_form($order->duration, ['день', 'дні', 'днів'])}}</b>
                                            </span>
            </div>
        </div>
        <hr>
    @endif
    <div class="row">
        <div class="col-sm-6 col-12">
            <span class="text">Кількість учасників</span>
        </div>

        <div class="col-sm-6 col-12">
            <span class="text"><b>{{$order->places}}</b></span>
        </div>
    </div>
    <hr>
    @if($order->children)
        <div class="row">
            <div class="col-sm-6 col-12">
                <span class="text">Діти</span>
            </div>

            <div class="col-sm-6 col-12">
                <span class="text"><b>{{$order->total_children}}</b></span>
            </div>
        </div>
        <hr>
    @endif
    @if($order->price > 0)
        <div class="row">
            <div class="col-sm-6 col-12">
                <span class="text">Вартість туру</span>
            </div>

            <div class="col-sm-6 col-12">
                                            <span
                                                class="text"><b>{{number_format($order->price)}}  {{currency_title($order->currency)}}</b></span>
            </div>
        </div>
        <hr>
    @endif
    @if($order->accomm_price > 0)
        <div class="row">
            <div class="col-sm-6 col-12">
                <span class="text">Доплата за проживання</span>
            </div>

            <div class="col-sm-6 col-12">
                                            <span
                                                class="text"><b>{{number_format($order->accomm_price)}}  {{currency_title($order->currency)}}</b></span>
            </div>
        </div>
        <hr>
    @endif
    @if($order->is_tour_agent && $order->commission > 0)
        <div class="row">
            <div class="col-sm-6 col-12">
                <span class="text">Комісія турагенту</span>
            </div>

            <div class="col-sm-6 col-12">
                                        <span
                                            class="text"><b>{{number_format($order->commission)}}  {{currency_title($order->currency)}}</b></span>
            </div>
        </div>
        <hr>
    @endif
    @if($order->offer_date)
        <div class="row">
            <div class="col-sm-6 col-12">
                <span class="text">До якої дати надіслати пропозицію</span>
            </div>

            <div class="col-sm-6 col-12">
                <span class="text"><b>{{date_title($order->offer_date)}}</b></span>
            </div>
        </div>
        <hr>
    @endif
    @if($order->discounts)
        @foreach($order->discounts as $discount)
            <div class="row">
                <div class="col-sm-6 col-12">
                    <span class="text">{{$discount['title']}}</span>
                </div>

                <div class="col-sm-6 col-12">
                                                <span class="text">
                                                    <b>-{{number_format($discount['value'])}} {{currency_title($order->currency)}}</b>
                                                </span>
                </div>
            </div>
            <hr>
        @endforeach
    @endif
    @if($order->total_price > 0)
        <div class="row">
            <div class="col-sm-6 col-12">
                <span class="text">Кінцева вартість</span>
            </div>

            <div class="col-sm-6 col-12">
                                            <span
                                                class="text"><b>{{number_format($order->total_price)}}  {{currency_title($order->currency)}}</b></span>
            </div>
        </div>
        <hr>
    @endif
    @if($order->confirmation_type > 0)
        <div class="row">
            <div class="col-sm-6 col-12">
                <span class="text">Спосіб підтвердження</span>
            </div>

            <div class="col-sm-6 col-12">
                <span class="text"><b>{{$order->confirmation_title}}</b></span>
            </div>
        </div>
        <hr>
    @endif
    <div class="row">
        <div class="col-sm-6 col-12">
            <span class="text">Номер замовлення</span>
        </div>

        <div class="col-sm-6 col-12">
            <span class="text"><b>{{$order->order_number}}</b></span>
        </div>
    </div>
</div>
