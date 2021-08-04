<div {{$attributes->merge(['class'=>'exchange dropdown'])}}>
    <span>{{$currentCurrencyISO}} - <span>{{$currentCurrencySymbol}}</span></span>
    <span class="dropdown-btn"></span>
    <ul class="dropdown-toggle">
        @foreach($currencies as $iso=>$symbol)
            <li>
                <a href="{{route('currency.change', strtolower($iso))}}">{{$iso}} - {{$symbol}}</a>
            </li>
        @endforeach
    </ul>
    <div class="full-size"></div>
</div>
