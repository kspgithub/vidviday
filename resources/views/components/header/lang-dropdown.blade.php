@if(count($localeLinks) > 1)
    <div class="lang dropdown {{$class}}" v-is="'lang-dropdown'" current-locale="{{$currentLocale}}">
        <span class="dropdown-title as-link">{{strtoupper($currentLocale)}}</span>
        <span class="dropdown-btn"></span>
        <ul class="dropdown-toggle">
            @foreach($localeLinks as  $language=>$url)
                @if($language !== $currentLocale)
                    <li>
                        <a href="{{$url}}">{{strtoupper($language)}}</a>
                    </li>
                @endif
            @endforeach
        </ul>
        <div class="full-size"></div>
    </div>
@else
    <div class="lang" v-is="'lang-dropdown'" current-locale="{{$currentLocale}}">
        <span>{{strtoupper($currentLocale)}}</span>
        <div class="full-size"></div>
    </div>
@endif
