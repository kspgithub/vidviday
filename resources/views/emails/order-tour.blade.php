@extends('emails.layout')

@section('content')
    <div class="body">
        <div style="text-align: center;">
            <span
                style="font-family: 'Roboto', sans-serif; font-weight: 500; font-size: 16px; line-height: 28px; color: #626262;">
                @if($order->type === Order::GROUP_CORPORATE)
                    Замовлення корпоративу
                @else
                    Замовлення туру
                @endif

                #{{$order->order_number}}
            </span>
            <br>
            @if(!empty($order->tour))
                <span class="title">{{$order->tour->title}}</span>
                @if(!empty($order->tour->short_text))
                    <br>
                    <span
                        style="font-family: 'Roboto', sans-serif; font-size: 14px; line-height: 24px; color: #626262;">
                        {!! $order->tour->short_text !!}
                    </span>
                @endif
            @endif
        </div>

        <!-- TABLE -->
        <table>
            <tr>
                <td style="font-family: 'Roboto', sans-serif; color: #626262; border-bottom: 1px solid #E9E9E9;">
                    Номер замовлення
                </td>

                <td style="font-family: 'Roboto', sans-serif; font-weight: 700; border-bottom: 1px solid #E9E9E9;">
                    {{$order->order_number}}
                </td>
            </tr>
            @if(!empty($order->tour))
                <tr>
                    <td style="font-family: 'Roboto', sans-serif; color: #626262; border-bottom: 1px solid #E9E9E9;">
                        Тур
                    </td>

                    <td style="font-family: 'Roboto', sans-serif; font-weight: 700; border-bottom: 1px solid #E9E9E9;">
                        {{$order->tour->title}}
                    </td>
                </tr>
            @else
                <tr>
                    <td style="font-family: 'Roboto', sans-serif; color: #626262; border-bottom: 1px solid #E9E9E9;">
                        Тур
                    </td>

                    <td style="font-family: 'Roboto', sans-serif; font-weight: 700; border-bottom: 1px solid #E9E9E9;">
                        Корпоративний тур
                    </td>
                </tr>
            @endif

            <tr>
                <td style="font-family: 'Roboto', sans-serif; color: #626262; border-bottom: 1px solid #E9E9E9;">
                    Дата виїзду
                </td>

                <td style="font-family: 'Roboto', sans-serif; font-weight: 700; border-bottom: 1px solid #E9E9E9;">
                    {{$order->start_title}}
                </td>
            </tr>

            <tr>
                <td style="font-family: 'Roboto', sans-serif; color: #626262; border-bottom: 1px solid #E9E9E9;">
                    Кількість учасників
                </td>

                <td style="font-family: 'Roboto', sans-serif; font-weight: 700; border-bottom: 1px solid #E9E9E9;">
                    {{$order->places.' '.plural_form($order->places, ['особа', 'особи', 'осіб'])}}
                </td>
            </tr>
            @if($order->children)
                <tr>
                    <td style="font-family: 'Roboto', sans-serif; color: #626262; border-bottom: 1px solid #E9E9E9;">
                        Діти
                    </td>

                    <td style="font-family: 'Roboto', sans-serif; font-weight: 700; border-bottom: 1px solid #E9E9E9;">
                        {{$order->total_children}}
                    </td>
                </tr>
            @endif
            <tr>
                <td style="font-family: 'Roboto', sans-serif; color: #626262; border-bottom: 1px solid #E9E9E9;">
                    Контактна особа
                </td>

                <td style="font-family: 'Roboto', sans-serif; font-weight: 700; border-bottom: 1px solid #E9E9E9;">
                    {{$order->last_name}}  {{$order->first_name}}
                </td>
            </tr>

            <tr>
                <td style="font-family: 'Roboto', sans-serif; color: #626262; border-bottom: 1px solid #E9E9E9;">
                    Телефон
                </td>

                <td style="font-family: 'Roboto', sans-serif; font-weight: 700; border-bottom: 1px solid #E9E9E9;">
                    {{$order->phone}}
                </td>
            </tr>

            <tr>
                <td style="font-family: 'Roboto', sans-serif; color: #626262; border-bottom: 1px solid #E9E9E9;">
                    Email
                </td>

                <td style="font-family: 'Roboto', sans-serif; font-weight: 700; border-bottom: 1px solid #E9E9E9;">
                    {{$order->email}}
                </td>
            </tr>
            @if($order->price > 0)
                <tr>
                    <td style="font-family: 'Roboto', sans-serif; color: #626262; border-bottom: 1px solid #E9E9E9;">
                        Вартість туру
                    </td>

                    <td style="font-family: 'Roboto', sans-serif; font-weight: 700; border-bottom: 1px solid #E9E9E9;">
                        {{number_format($order->price)}}  {{currency_title($order->currency)}}
                    </td>
                </tr>
            @endif
            @if($order->commission > 0)
                <tr>
                    <td style="font-family: 'Roboto', sans-serif; color: #626262; border-bottom: 1px solid #E9E9E9;">
                        Комісія турагенту
                    </td>

                    <td style="font-family: 'Roboto', sans-serif; font-weight: 700; border-bottom: 1px solid #E9E9E9;">
                        {{number_format($order->commission)}}  {{currency_title($order->currency)}}
                    </td>
                </tr>

            @endif
            @if($order->offer_date)
                <tr>
                    <td style="font-family: 'Roboto', sans-serif; color: #626262; border-bottom: 1px solid #E9E9E9;">
                        До якої дати надіслати пропозицію
                    </td>

                    <td style="font-family: 'Roboto', sans-serif; font-weight: 700; border-bottom: 1px solid #E9E9E9;">
                        {{date_title($order->offer_date)}}
                    </td>
                </tr>
            @endif
            @if($order->discounts)


                @foreach($order->discounts as $discount)
                    <tr>
                        <td style="font-family: 'Roboto', sans-serif; color: #626262; border-bottom: 1px solid #E9E9E9;">
                            {{$discount['title']}}
                        </td>

                        <td style="font-family: 'Roboto', sans-serif; font-weight: 700; border-bottom: 1px solid #E9E9E9;">
                            -{{number_format($discount['value'])}} {{currency_title($order->currency)}}
                        </td>
                    </tr>

                @endforeach
            @endif
            @if($order->price > 0)
                <tr>
                    <td style="font-family: 'Roboto', sans-serif; color: #626262; border-bottom: 1px solid #E9E9E9;">
                        Кінцева вартість
                    </td>

                    <td style="font-family: 'Roboto', sans-serif; font-weight: 700; border-bottom: 1px solid #E9E9E9;">
                        {{number_format($order->total_price)}}  {{currency_title($order->currency)}}
                    </td>
                </tr>
            @endif


            <tr>
                <td style="font-family: 'Roboto', sans-serif; color: #626262; border-bottom: 1px solid #E9E9E9;">
                    Спосіб оплати
                </td>

                <td style="font-family: 'Roboto', sans-serif; font-weight: 700; border-bottom: 1px solid #E9E9E9;">
                    {{$order->payment_title}}
                </td>
            </tr>

            <tr>
                <td style="font-family: 'Roboto', sans-serif; color: #626262;">Спосіб підтвердження</td>

                <td style="font-family: 'Roboto', sans-serif; font-weight: 700;">
                    {{$order->confirmation_title}}
                </td>
            </tr>
        </table>
        <!-- TABLE END -->

        <div style="text-align: center; margin-bottom: 30px;">
            <span style="font-family: 'Roboto', sans-serif; font-size: 14px; line-height: 24px; color: #626262;">Дякуємо за те, що обрали нас!</span>
        </div>
    </div>
@endsection
