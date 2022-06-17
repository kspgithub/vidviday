<div class="right-sidebar">
    <div class="right-sidebar-inner">
        @isset($button)
            <div class="only-desktop mb-20">
                <a class="btn type-1 btn-block btn-big font-lg" href="{{$button['url']}}">{{$button['title']}}</a>
            </div>
        @endisset
        @if(in_array('share', $pageContent->sidebar_items ?? []))
            <div class="bordered-box only-desktop-pad">
                <x-sidebar.download-print/>
                <hr>
                <x-sidebar.social-share :share-url="route('page.show', $pageContent->slug)" :share-title="$pageContent->title"/>
            </div>
        @endif
        @if(in_array('contacts', $pageContent->sidebar_items ?? []) && $pageContent->contact)
            <x-sidebar.contact :staff="$pageContent->contact"/>
        @endif
        @if(in_array('testimonials', $pageContent->sidebar_items ?? []))
            <x-sidebar.latest-testimonials title="Нас рекомендують" btn-text="Показати ще"/>
        @endif
    </div>
</div>

