<div class="right-sidebar">
    <div class="right-sidebar-inner">
        @isset($button)
            @php
                $onclick = ($button['logout'] ?? false) === true ?'event.preventDefault(); document.getElementById(\'header-logout-form-redirect\').value = '.$button['url'].'; document.getElementById(\'header-logout-form\').submit();' : '';
            @endphp
            <div class="only-desktop mb-20">
                <x-seo-button :code="'common.right_sidebar_button'" class="btn type-1 btn-block btn-big font-lg"
                              onclick="{{$onclick}}"
                              href="{{$button['url']}}">{{$button['title']}}</x-seo-button>
            </div>
        @endisset
        @if(in_array('share', $pageContent->sidebar_items ?? []))
            <div class="bordered-box only-desktop-pad">
                <x-sidebar.download-print/>
                <hr>
                <x-sidebar.social-share :share-url="route('page.show', $pageContent->slug)"
                                        :share-title="$pageContent->title"/>
            </div>
        @endif

        <div class="only-mobile">

            <div class="spacer-sm"></div>
        </div>

        @if(in_array('contacts', $pageContent->sidebar_items ?? []) && $pageContent->contact)
            <x-sidebar.contact :staff="$pageContent->contact"/>
        @endif
        @if(in_array('testimonials', $pageContent->sidebar_items ?? []))
            <x-sidebar.recommendations :page="$pageContent"/>
        @endif
    </div>
</div>

