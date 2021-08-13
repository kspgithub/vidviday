<div class="lang dropdown" v-is="'lang-dropdown'" current-locale="{{$currentLocale}}">
    <span>{{strtoupper($currentLocale)}}</span>
    <span class="dropdown-btn"></span>
    <ul class="dropdown-toggle">
        @foreach($languages as  $language)
            @if($language !== $currentLocale)
                <li>
                    <a href="{{route('locale.change', $language)}}">{{strtoupper($language)}}</a>
                </li>
            @endif
        @endforeach

    </ul>
    <div class="full-size"></div>
</div>
