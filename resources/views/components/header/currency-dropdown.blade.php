<div {{$attributes->merge(['class'=>'exchange dropdown'])}}
     v-is="'currency-dropdown'"
     :current='@json($current)'
>
    <span class="dropdown-title as-link">{{$currentCurrencyISO}} - <span>{{$currentCurrencySymbol}}</span></span>
    <span class="dropdown-btn"></span>
    <ul class="dropdown-toggle">
        @foreach($currencies as $currency)
            <li>
                <a href="{{route('currency.change', strtolower($currency->iso))}}">
                    {{$currency->iso}} - {{$currency->symbol}}
                </a>
            </li>
        @endforeach
    </ul>
    <div class="full-size"></div>
</div>
